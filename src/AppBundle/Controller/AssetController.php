<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/01/2018
 * Time: 20:59
 */

namespace AppBundle\Controller;


use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\Asset;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Fit;
use AppBundle\Entity\FitData;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\UserUtil;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class AssetController extends Controller
{

    /**
     * Remove a group
     *
     * @Route("/asset/update/{id}", name="update-asset")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function assetUpdateAction(Request $request, $id)
    {

        $parameters = ControllerUtil::before($this);

        /**
         * @var User $user
         */
        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);


        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($id);

        if($api === null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Tu n\'as pas le droit d\'update les assets des autres membres');
        }

        $api->setLastAssetUpdate(new \DateTime());
        $this->getDoctrine()->getManager()->flush();


        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($authentication);


        $em = $this->getDoctrine()->getManager();
        $assetRep = $em->getRepository(Asset::class);
        $itemRep = $em->getRepository(Item::class);

        //delete old asset
        $oldAset = $assetRep->findByOwner($api);
        foreach ($oldAset as $old){
            $em->remove($old);
        }
        $em->flush();

        $assetData = array();
        $page = 1;

        do{

            try {
                $assetTmp = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/assets/', ['character_id' => $api->getCharId()], ['page' => $page]);
            } catch (EsiException $e) {
                $parameters['esi_exception'] = $e;
                return $this->render('error/esi.html.twig', $parameters);
            }

            foreach ($assetTmp->getArrayCopy() as $tmp){
                $assetData[] = $tmp;
            }
            $page = $page + 1;

        }while(count($assetTmp->getArrayCopy())>0);

        //die('lel' . count($assetData));





        foreach ($assetData as $asset){
            $assetDB = $assetRep->findAll($asset->item_id);
            if($assetDB == null)
                $assetDB = new Asset();

            $assetDB->setId($asset->item_id)
                ->setOwner($api)
                ->setItem($itemRep->find($asset->type_id))
                ->setLocation($asset->location_id)
                ->setQuantity($asset->quantity)
                ->setLocationFlag($asset->location_flag)
                ->setLocationType($asset->location_type)
                ->setIsSingleton($asset->is_singleton);
            $em->persist($assetDB);
        }
        $em->flush();


        $assets = $assetRep->findByOwner($api);


        /**
         * @var Asset $asset
         */
        foreach ($assets as $asset){
            $parent = $assetRep->find($asset->getLocation());
            if($parent != null){
                $asset->setParent($parent);
                $em->persist($asset);
            }
        }

        $em->flush();

        $assetTmp = array();
        $count = 0;
        $last = end($assets);
        foreach ($assets as $asset) {
            $assetTmp[] = $asset->getId();

            $count = $count + 1;

            if($count>=1000 or $asset === $last){
                try {
                    $esi->setBody($assetTmp);
                    $esi->setQueryString(array());

                    $assetNames = EsiUtil::callESI($esi, 'post', '/characters/{character_id}/assets/names/', ['character_id' => $api->getCharId()], array(), $assetTmp);

                    foreach ($assetNames->getArrayCopy() as $assetName){
                        if($assetName->name !== "" and $assetName->name !== "None"){
                            $item = $assetRep->find($assetName->item_id);
                            $item->setName($assetName->name);
                            $em->persist($item);
                        }
                    }
                    $count = 0;
                    $assetTmp = array();

                } catch (EsiException $e) {
                    $parameters['esi_exception'] = $e;
                    return $this->render('error/esi.html.twig', $parameters);
                }
            }
        }

        $em->flush();


        return $this->redirect($this->generateUrl('asset-list', array('id' => $api->getId())));
    }

    /**
     *
     *
     * @Route("/asset/ship/{id}", name="asset-ship")
     * @Security("has_role('ROLE_MEMBER')")
     * @ParamConverter(name="ship")
     */
    public function assetShipAction(Request $request, Asset $ship)
    {
        $parameters = ControllerUtil::before($this);
        $user = $this->getUser();


        if($ship->getOwner()->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Tu n\'as pas le droit de voir les ships des autres');
        }

        if(!$ship->getItem()->getItemGroup()->getCategory()->getId() == 6){  //TODO
            //TODO error management
        }

        $fit = new Fit();
        $fit->setName($ship->getName())->setShip($ship->getItem());

        $modules = array();

        /**
         * @var Asset $child
         */
        foreach ($ship->getChilds() as $child){
            if(substr( $child->getLocationFlag(), 0, 6 ) === "HiSlot"){
                if(!isset($modules[0])) $modules[0] = array();
                $modules[0][] = $child;
            }

            if(substr( $child->getLocationFlag(), 0, 7 ) === "MedSlot"){
                if(!isset($modules[1])) $modules[1] = array();
                $modules[1][] = $child;
            }

            if(substr( $child->getLocationFlag(), 0, 6 ) === "LoSlot"){
                if(!isset($modules[2])) $modules[2] = array();
                $modules[2][] = $child;
            }

            if(substr( $child->getLocationFlag(), 0, 7 ) === "RigSlot"){
                if(!isset($modules[3])) $modules[3] = array();
                $modules[3][] = $child;
            }

            if( $child->getLocationFlag() === "DroneBay"){
                if(!isset($modules[4])) $modules[4] = array();
                $modules[4][] = $child;
            }

            if( $child->getLocationFlag() === "FighterBay"){
                if(!isset($modules[5])) $modules[5] = array();
                $modules[5][] = $child;
            }

            if( $child->getLocationFlag() === "Cargo"){
                if(!isset($modules[6])) $modules[6] = array();
                $modules[6][] = $child;
            }

            if( $child->getLocationFlag() === "FleetHangar"){
                if(!isset($modules[7])) $modules[7] = array();
                $modules[7][] = $child;
            }

            /*
            if( $child->getLocationFlag() === "Cargo"){ //TODO ship hangar
                if(!isset($modules[6]) $modules[6] = array();
                $modules[6][] = $child;
            }
            */
        }


        foreach ($modules as $id => $modulesSlot){

            foreach ($modulesSlot as $module){
                $fitData = new FitData();
                $fitData->setSlot($id)->setQuantity($module->getQuantity())->setItem($module->getItem());

                $fit->addFitData($fitData);
            }

        }

        $parameters['fit'] = $fit;


        return $this->render('asset/ship.html.twig', $parameters);


    }

    /**
     *
     *
     * @Route("/asset/{id}", name="asset-list")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function assetListAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        /**
         * @var User $user
         */
        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($id);

        if($api === null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Tu n\'as pas le droit de voir les assets des autres membres');
        }

        $parameters['api'] = $api;

        return $this->render('asset/test.html.twig', $parameters);


    }

    /**
     *
     *
     * @Route("/asset", name="asset")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function assetAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);
        $apis = $apiRep->findByUser($user);

        $parameters['apis'] = $apis;

        return $this->render('asset/index.html.twig', $parameters);


    }
}