<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/12/2018
 * Time: 21:38
 */

namespace AppBundle\Controller;

use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Fleet;
use AppBundle\Entity\FleetMember;
use AppBundle\Entity\Item;
use AppBundle\Util\ControllerUtil;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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

        $form = $this->createFormBuilder()
            ->add('link',UrlType::class, array('label' => 'Link'))
            ->add('description',TextType::class, array('label' => 'Description'))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer',  'attr' => array(
                'class' => 'btn-admin')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $link = $data['link'];

            $auth = EsiUtil::getDefaultAuthentication($this->getUser()->getApis()[0]->getRefreshToken()); //TODO main api
            $esi = new Eseye($auth);

            $matches = array();
            $regex = '/https:\/\/esi.tech.ccp.is\/v1\/fleets\/(\d+)\/\?datasource=tranquility/';
            preg_match($regex, $link, $matches);
            dump($matches);

            if(count($matches) != 2 and !is_int($matches[1])){
                //TODO error management
            }
            else{
                $fleetEsi = EsiUtil::callESI($esi, 'get', '/fleets/{fleet_id}/members/', array('fleet_id' => $matches[1]));
                $members = $fleetEsi->getArrayCopy();

                $fleet = new Fleet();
                $fleet->setDate(new \DateTime());
                $fleet->setDescription($data['description']);

                foreach ($members as $member){


                    $api = $apiRep->findOneByCharId($member->character_id);
                    if(!$api){
                        //TODO membre non existant
                    }
                    else{
                        $fleetMember = new FleetMember();
                        $fleetMember->setApi($api);
                        $fleetMember->setShip($itemRep->find($member->ship_type_id));
                        $fleetMember->setFleet($fleet);
                        $doctrine->getManager()->persist($fleetMember);
                        $fleet->addMember($fleetMember);
                    }
                }


                $doctrine->getManager()->persist($fleet);
                $doctrine->getManager()->flush();

                return $this->redirect($this->generateUrl('fleet-info', array('id' => $fleet->getId())));
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