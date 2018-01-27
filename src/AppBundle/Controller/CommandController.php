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
use AppBundle\Util\GroupUtil;
use AppBundle\Util\Util;
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



class CommandController extends Controller
{

    /**
     * Add a command
     *
     * @Route("/command/add", name="commandadd")
     */
    public function commandAddAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();




        $form = $this->createFormBuilder()
            ->add('items', CollectionType::class, array('entry_type'   => HiddenType::class,
                'allow_add' => true,))
            ->add('quantity', CollectionType::class, array('entry_type'   => NumberType::class,
                'allow_add' => true,))
            ->add('save', SubmitType::class, array('label' => 'Ajouter commande',  'attr' => array(
          'class' => 'btn-admin')))
            ->add('important', CheckboxType::class, array('label' => 'Reservé au responsable de production?'))
            ->getForm();

        $form->handleRequest($request);
        $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getRepository(Item::class);

            $data = $form->getData();

            if(count($data['items']) == 0) return $this->redirect($this->generateUrl('commandadd'));


            $command = new Command();

            $command->setIssuer($parameters['user'])->setState('pending')->setDate(new \DateTime());
            $command->setImportant($data['important']);


            $evePraisalData = json_decode(Util::getEvePraisal($data, $this->getDoctrine()->getRepository(Item::class)), true);

            $command->setEstimatedPrice($evePraisalData['appraisal']['totals']['sell']);

            //die($evePraisalData['appraisal']['id']);

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
            }

            return $this->redirect($this->generateUrl('commandlist'));
        }

        $parameters['form'] = $form->createView();
        return $this->render('command/add.html.twig', $parameters);
    }

    /**
     * Commands list
     *
     * @Route("/commands", name="commandlist")
     */
    public function commandListAction(Request $request, $userId = null)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

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
     */
    public function userCommandListAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        return $this->commandListAction($request, $id);

    }

    /**
     * Show command information
     *
     * @Route("/commands/{id}", name="commandinfo")
     */
    public function commandAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

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
     */
    public function commandAcceptAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var $command Command
         */
        $command = $commandRep->find($id);

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
     */
    public function commandRefuseAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var $command Command
         */
        $command = $commandRep->find($id);

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
     */
    public function removeMyCommandAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        /**
         * @var Command $commands
         */
        $command = $commandRep->find($id);

        if($command!= null){
            if($command->getIssuer()->getId() != $parameters['user']->getId() and !$parameters['user']->isAdmin)
                die("You need to be admin to remove other people command"); //TODO better


            $doctrine->getManager()->remove($command);
            $doctrine->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('commandlist'));

    }


}
