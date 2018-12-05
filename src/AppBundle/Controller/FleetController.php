<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/12/2018
 * Time: 21:38
 */

namespace AppBundle\Controller;

use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Fleet;
use AppBundle\Entity\FleetMember;
use AppBundle\Entity\Item;
use AppBundle\Entity\System;
use AppBundle\Util\ControllerUtil;
use GuzzleHttp\Exception\ServerException;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FleetController
 * @package AppBundle\Controller
 * @Security("has_role('ROLE_ADMIN')")
 */
class FleetController extends Controller
{

    /**
     *
     * This route is the homepage
     *
     * @Route("/fleet", name="fleet")
     */
    public function indexAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);
        $itemRep = $this->getDoctrine()->getRepository(Item::class);
        $systemRep = $this->getDoctrine()->getRepository(System::class);

        $form = $this->createFormBuilder()
            ->add('link',UrlType::class, array('label' => 'Link', 'attr' => array('style' => 'color:black')))
            ->add('description',TextType::class, array('label' => 'Description', 'attr' => array('style' => 'color:black')))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer',  'attr' => array(
                'class' => 'btn-primary')))
            ->add('api', ChoiceType::class, [
                'label' => 'Personnage dans la fleet',
                'choices' => $this->getUser()->getApis(),

                'choice_label' => function($api, $key, $value) {
                    /** @var CharApi $api */
                    return strtoupper($api->getCharName());
                },
                'attr' => array('style' => 'color:black;')
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            //dump($data);
            $link = $data['link'];

            $auth = EsiUtil::getDefaultAuthentication($data['api']->getRefreshToken());
            $esi = new Eseye($auth);

            $matches = array();
            $regex = '/https:\/\/esi.tech.ccp.is\/v1\/fleets\/(\d+)\/\?datasource=tranquility/';
            preg_match($regex, $link, $matches);


            if(count($matches) == 2 and is_numeric($matches[1])){
                try {
                    $fleetEsi = EsiUtil::callESI($esi, 'get', '/fleets/{fleet_id}/members/', array('fleet_id' => $matches[1]));
                    $members = $fleetEsi->getArrayCopy();

                    $fleet = new Fleet();
                    $fleet->setDate(new \DateTime());
                    $fleet->setDescription($data['description']);

                    foreach ($members as $member) {

                        $api = $apiRep->findOneByCharId($member->character_id);

                        $fleetMember = new FleetMember();
                        $fleetMember->setCharId($member->character_id)->setShip($itemRep->find($member->ship_type_id))->setFleet($fleet)->setSystem($systemRep->find($member->solar_system_id));

                        if (!$api) {
                            $memberEsi = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $member->character_id));

                        $fleetMember->setCharName($memberEsi->name);
                    } else {
                            $fleetMember->setCharName($api->getCharName());
                            $fleetMember->setApi($api);
                        }
                        $doctrine->getManager()->persist($fleetMember);
                        $fleet->addMember($fleetMember);
                    }

                    $doctrine->getManager()->persist($fleet);
                    $doctrine->getManager()->flush();

                    return $this->redirect($this->generateUrl('fleet-info', array('id' => $fleet->getId())));
                }
                catch (EsiException $e){
                    if($e->getCode() == 4){
                        $form->addError(new FormError('Tu n\'est pas dans la fleet avec ce personnage ou tu n\'es pas le boss'));
                    }
                    else{
                        $form->addError(new FormError('Erreur ESI (Erreur de CCP, serveur ESI offline, etc...')); //TODO more specific
                    }
                }
                catch (\Exception $e){
                    if($e->getCode() == 520){ //la fleet n'existe plus
                        $form->addError(new FormError('La fleet n\'existe pas!')); //TODO more specific
                    }
                    else{
                        $form->addError(new FormError('Erreur inconue')); //TODO more specific
                    }

                }
            }
            else{
                $form->addError(new FormError('URL invalid'));
            }

        }


        $parameters['form'] = $form->createView();
        return $this->render('fleet/index.html.twig', $parameters);

    }



    /**
     *
     * This route is the homepage
     *
     * @Route("/fleet/list", name="fleet-list")
     */
    public function listAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $fleetRep = $this->getDoctrine()->getRepository(Fleet::class);

        $fleets = $fleetRep->createQueryBuilder('f')->orderBy('f.date')->getQuery()->execute();


        $parameters['fleets'] = $fleets;
        return $this->render('fleet/list.html.twig', $parameters);

    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/fleet/{id}", name="fleet-info")
     * @ParamConverter(name="fleet")
     */
    public function fleetInformationAction(Request $request, Fleet $fleet)
    {

        $parameters['fleet'] = $fleet;
        return $this->render('fleet/info.html.twig', $parameters);

    }

}