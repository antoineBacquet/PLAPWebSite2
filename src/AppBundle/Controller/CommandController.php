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
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\Util;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('save', SubmitType::class, array('label' => 'Ajouter commande'))
            ->getForm();

        $form->handleRequest($request);
        $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getRepository(Item::class);

            $data = $form->getData();

            if(count($data['items']) == 0) return $this->redirect($this->generateUrl('commandadd'));


            $command = new Command();

            $command->setIssuer($parameters['user'])->setState('pending')->setDate(new \DateTime());

            $evePraisalData = json_decode(Util::getEvePraisal($data, $this->getDoctrine()->getRepository(Item::class)), true);

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
    public function commandListAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        $commands = $commandRep->findAll();
        $parameters['commands'] = $commands;

        return $this->render('command/liste.html.twig', $parameters);

    }

}