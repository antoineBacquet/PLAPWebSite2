<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 12/11/2017
 * Time: 17:15
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Command;
use AppBundle\Entity\CommandItem;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\DiscordUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\Util;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class CommandController extends Controller
{

    /**
     * Add a command
     *
     * @Route("/command/add", name="commandadd")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function commandAddAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $doctrine = $this->getDoctrine();




        $form = $this->createFormBuilder()
            ->add('items', CollectionType::class, array('entry_type'   => HiddenType::class,
                'allow_add' => true,))
            ->add('quantity', CollectionType::class, array('entry_type'   => NumberType::class,
                'allow_add' => true,))
            ->add('save', SubmitType::class, array('label' => 'Ajouter commande',  'attr' => array(
          'class' => 'btn-admin')))
            ->add('important', CheckboxType::class, array('label' => 'Reservé au responsable de production? ', 'required' => false,))
            ->getForm();

        $form->handleRequest($request);
        $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getRepository(Item::class);

            $data = $form->getData();

            if(count($data['items']) == 0) return $this->redirect($this->generateUrl('commandadd'));

            //TODO error feedback
            for ( $i=0 ; $i<count($data['items']) ; $i++)
                if($data['quantity'][$i] == null or $data['quantity'][$i] <1)
                    $data['quantity'][$i] = 1;

            $command = new Command();

            $command->setIssuer($user)->setState('pending')->setDate(new \DateTime());
            $command->setImportant($data['important']);


            $evePraisalData = json_decode(Util::getEvePraisal($data, $this->getDoctrine()->getRepository(Item::class)), true);

            $command->setEstimatedPrice($evePraisalData['appraisal']['totals']['sell']);

            $command->setEvepraisal("http://evepraisal.com/a/" .$evePraisalData['appraisal']['id'] );


            $doctrine->getManager()->persist($command);
            $doctrine->getManager()->flush();


            for ( $i=0 ; $i<count($data['items']) ; $i++){
                $commandItem = new CommandItem();
                $commandItem->setItem($em->find($data['items'][$i]));
                $commandItem->setQuantity($data['quantity'][$i]);

                $commandItem->setCommand($command);
                $doctrine->getManager()->persist($commandItem);
                $doctrine->getManager()->flush();
                $command->addItem($commandItem);
            }

            $url = $request->getScheme() . '://' . $request->getHttpHost() . $this->generateUrl('commandinfo', array('id' => $command->getId()));
            DiscordUtil::sendNewCommand($command, $url);

            return $this->redirect($this->generateUrl('commandlist'));
        }

        $parameters['form'] = $form->createView();
        return $this->render('command/add.html.twig', $parameters);
    }

    /**
     * Commands list
     *
     * @Route("/commands", name="commandlist")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function commandListAction(Request $request, $userId = null)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);
        $userRep = $doctrine->getRepository(User::class);

        if($userId == null){
            $commands = $commandRep->findBy(array(), array('id' => 'DESC'));
        }
        else{
            $commands = $commandRep->findBy(array('issuer' => $userRep->findOneById($userId) ), array('id' => 'DESC'));
        }
        $parameters['commands'] = $commands;

        return $this->render('command/liste.html.twig', $parameters);

    }

    /**
     * Commands list
     *
     * @Route("/commands/user/{id}", name="usercommandlist")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function userCommandListAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        return $this->commandListAction($request, $id);

    }

    /**
     * Show command information
     *
     * @Route("/commands/{id}", name="commandinfo")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function commandAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var Command $command
         */
        $command = $commandRep->find($id);
        $parameters['command'] = $command;

        $proposedForm = $this->createFormBuilder()
            ->add('prix_propose', NumberType::class, array('data' => $command->getEstimatedPrice()))
            ->add('save', SubmitType::class, array('label' => 'Proposer un prix'))
            ->getForm();

        $proposedForm->handleRequest($request);

        //die(var_dump($proposedForm->));

        if ($proposedForm->isSubmitted() && $proposedForm->isValid()){
            if(!is_numeric($proposedForm->getData()['prix_propose'])){
                $proposedForm->addError(new FormError('Le prix proposé doit étre un nombre'));
            }
            else{
                $doctrine = $this->getDoctrine();
                $commandRep = $doctrine->getRepository(Command::class);


                /**
                 * @var $command Command
                 */
                $command = $commandRep->find($id);

                if($command!= null){

                    $command->setContractor($parameters['user']);
                    $command->setState('proposed');

                    $command->setSuggestedPrice($proposedForm->getData()['prix_propose']);

                    $doctrine->getManager()->persist($command);
                    $doctrine->getManager()->flush();
                }
            }

        }
        $parameters['proposed_form'] = $proposedForm->createView();



        return $this->render('command/command.html.twig', $parameters);

    }

    /**
     * Add a command
     *
     * @Route("/command/accept/{id}", name="commandaccept")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function commandAcceptAction(Request $request, $id)
    {
        ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var $command Command
         */
        $command = $commandRep->find($id);

        if($command->getIssuer()->getId() != $this->getUser()->getId() )
            throw new AccessDeniedException('Tu ne peux pas accepté les commandes des autres');

        if($command!= null){
            $command->setState('accepted');

            $doctrine->getManager()->persist($command);
            $doctrine->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('commandinfo', array('id' => $id)));

    }

    /**
     * Add a command
     *
     * @Route("/command/refuse/{id}", name="commandrefuse")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function commandRefuseAction(Request $request, $id)
    {
        ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var $command Command
         */
        $command = $commandRep->find($id);

        if($command->getIssuer()->getId() != $this->getUser()->getId() )
            throw new AccessDeniedException('Tu ne peux pas refusé les commandes des autres');

        if($command!= null){

            $command->setContractor(null);
            $command->setSuggestedPrice(null);
            $command->setState('pending');

            $doctrine->getManager()->persist($command);
            $doctrine->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('commandinfo', array('id' => $id)));

    }

    /**
     * Add a command
     *
     * @Route("/commands/remove/{id}", name="removecommand")
     * @Security("has_role('ROLE_MEMBER')")
     * @ParamConverter(name="idn")
     */
    public function removeMyCommandAction(Request $request, Command $id)
    {
        ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $user = $this->getUser();

        if($id->getIssuer()->getId() != $user->getId() and !$this->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException('Tu doit étre admin pour supprimer le command des autres');


        $doctrine->getManager()->remove($id);
        $doctrine->getManager()->flush();


        return $this->redirect($this->generateUrl('commandlist'));

    }


}
