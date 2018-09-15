<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 18/11/2017
 * Time: 18:34
 */

namespace AppBundle\Controller;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\CCPUtil;
use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\Asset;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Item;
use AppBundle\Entity\System;
use AppBundle\Util\UserUtil;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AjaxController extends Controller
{
    /**
     * Get item information
     *
     * @Route("/ccpdata/item/search", name="searchitemajax")
     */
    public function ccpdataSearchItemAction(Request $request)
    {
        $text = $request->request->get('text');
        $response = "aze";
        if (strlen($text) > 0) {
            $words = explode(' ', $text);
            $whereSql = "";
            for ($i = 0; $i < count($words); $i++) {
                $whereSql = $whereSql . " upper(i.name) LIKE upper('%" . $words[$i] . "%') ";
                if ($i != (count($words) - 1))
                    $whereSql = $whereSql . " AND ";
            }
            //$response = $whereSql;
            $em = $this->getDoctrine()->getRepository(Item::class);
            $query = $em->createQueryBuilder('i')
                ->where($whereSql)
                ->orderBy('i.name', 'ASC')
                ->setMaxResults(10)
                ->getQuery();
            $results = $query->getResult();
            $response = array('results' => array());
            foreach ($results as $result){
                $response['results'][] = array('id' =>$result->getId(),  'name' =>$result->getName());
            }
        }
        return $this->json($response);
    }

    /**
     * Get item information
     *
     * @Route("/service/discord/test", name="testdiscord")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function discordTestAction(Request $request)
    {
        /*
         *
         */
        $user = $this->getUser();

        $response = [];
        if($user->getDiscordId() != null){

            $response['error'] = false;

            $webhook = new Client(DiscordConfig::$webhook_url);
            $embed = new Embed();

            $embed->description('Demande de test du discord');

            $webhook->username('Bot')->message('!test <@' . $user->getDiscordId() .'>')->embed($embed)->send();

                //TODO message de feedback
        }

        else{
            $response['error'] = true;
            $response['error_id'] = 2; // Not linked to the discord
        }



        return $this->json($response);


    }

    /**
     * Get item information
     *
     * @Route("/asset/getroot", name="getroot")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function getRootAction(Request $request)
    {

        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($request->get('api_id'));


        if($api === null){
            return $this->json(array('error' => 'Api non trouvée dans la DB'));
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            return $this->json(array('error' => 'Tu n\'as pas le droit de voir les assets des autres'));
        }


        $esi = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));

        $em = $this->getDoctrine()->getManager();
        $assetRep = $em->getRepository(Asset::class);

        $assetsDB = $assetRep->findBy(
            ['owner' => $api, 'parent' => null]
        );


        $assets = array();
        /**
         * @var Asset $asset
         */
       foreach ($assetsDB as $asset){

           $hasLocation = false;
           foreach($assets as $tmp )
               if($tmp['id'] === $asset->getLocation()) $hasLocation = true;

            if(!$hasLocation){
                $location = array();
                $location['children'] = true; //TODO test if it has children
                if($asset->getLocationType() === "station"){
                    //station
                    $location['id'] = $asset->getLocation();
                    try {
                        $station = EsiUtil::callESI($esi, 'get', '/universe/stations/{station_id}/', ['station_id' => $asset->getLocation()]);

                        $location['text'] = $station->name;
                        $location['icon'] = CCPConfig::$imageServer . $station->type_id.'_32.png';

                    } catch (EsiException $e) {
                        $location['text'] = 'Unknown station';

                    }

                    $assets[] = $location;

                }
                else if($asset->getLocationType() === "other" and $asset->getLocationFlag() === "Hangar"){
                    //Structure
                    $location['id'] = $asset->getLocation();
                    try {
                        $station = EsiUtil::callESI($esi, 'get', '/universe/structures/{structure_id}/', ['structure_id' => $asset->getLocation()]);

                        $location['text'] = $station->name;
                        $location['icon'] = CCPConfig::$imageServer . $station->type_id.'_32.png';

                    } catch (EsiException $e) {
                        $location['text'] = 'Unknown location';
                    }

                    $assets[] = $location;

                }


            }
        }

        return $this->json($assets);
    }

    /**
     * Get item information
     *
     * @Route("/asset/getchildren", name="getchildren")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function getChildrenAction(Request $request)
    {

        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($request->get('api_id'));


        if($api === null){
            return $this->json(array('error' => 'Api non trouvée dans la DB'));
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            return $this->json(array('error' => 'Tu n\'as pas le droit de voir les assets des autres'));
        }


        $em = $this->getDoctrine()->getManager();
        $assetRep = $em->getRepository(Asset::class);

        $assetsJson = array();
        $assets = $assetRep->findBy(
            ['owner' => $api, 'location' => $request->get('id')]
        );

        /**
         * @var Asset $asset
         */
        foreach ($assets as $asset){

            $itemName = "Unknown item";
            if($asset->getItem() !== null){
                $itemName = $asset->getItem()->getName();
            }



            $a_attr = null;
            $hasChildren = true;
            $children = $assetRep->findByLocation($asset->getId());
            if(count($children) === 0) $hasChildren = false;
            if($asset->getItem() !== null){
                $icon = CCPConfig::$imageServer . $asset->getItem()->getId().'_32.png';
                if($asset->getItem()->getItemGroup() != null and $asset->getItem()->getItemGroup()->getCategory()->getId() == 6){
                    $a_attr = array();
                    $a_attr['href'] = $this->generateUrl('asset-ship', array('id' => $asset->getId()));
                }
            }
            else $icon = false;

            $assetsJson[] = array('id' => $asset->getId(),
                'text' => $itemName . ' x ' . $asset->getQuantity() . ($asset->getName() === null? "" : ' - ' . $asset->getName()),
                'is_location' => false,
                'children' => $hasChildren, 'icon' => $icon,
                'a_attr' => $a_attr,

            );

        }

        return $this->json($assetsJson);
    }

    /**
     * Get item information
     *
     * @Route("/asset/search", name="asset-search")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function searchAssetAction(Request $request)
    {

        $user = $this->getUser();

        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);
        $assetRep = $this->getDoctrine()->getRepository(Asset::class);

        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($request->get('api_id'));

        if($api === null){
            return $this->json(array('error' => 'Api non trouvée dans la DB'));
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            return $this->json(array('error' => 'Tu n\'as pas le droit de voir les assets des autres'));
        }

        $esi = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));


        $qb = $assetRep->createQueryBuilder('a');
        $resultsDB = $qb
            ->join('a.item', 'i')
            ->join('i.itemGroup', 'g')
            ->join('g.category', 'c')
            ->Where('a.name like \'%' . $request->get('text') . '%\'')
            ->orWhere('i.name like \'%' . $request->get('text') . '%\'')
            ->orWhere('g.name like \'%' . $request->get('text') . '%\'')
            ->orWhere('c.name like \'%' . $request->get('text') . '%\'')
            ->andWhere('a.owner =' . $api->getId())
            ->getQuery()->execute();

        //dump($qb->getQuery()->getSQL());

        if(count($resultsDB) === 0) return $this->json(array('text' => 'Aucun resultat'));
        $results = array();

        /**
         * @var Asset $resultDB
         */
        foreach ($resultsDB as $resultDB){


            $currentNode = false;
            $current = $resultDB;
            $hasParent = true;

            while($hasParent){

                $itemName = "Unknown item";
                $icon = false;
                if($current->getItem() !== null){
                    $itemName = $current->getItem()->getName();
                    $icon = CCPConfig::$imageServer . $current->getItem()->getId().'_32.png';
                }

                $parent = array('id' => $current->getId(),
                    'text' => $itemName . ' x ' . $current->getQuantity() . ($current->getName() === null? "" : ' - ' . $current->getName()),
                    'is_location' => false,
                    'icon' => $icon,
                    'state' => array('opened' => true)
                );
                if($currentNode)$parent['children'] = array($currentNode);

                $currentNode = $parent;

                if($current->getParent() === null)
                    $hasParent = false;
                else{
                    $current = $current->getParent();
                }
            }

            $location = array();
            $location['children'] = array($currentNode);
            if($current->getLocationType() === "station"){
                //station
                $location['id'] = $current->getLocation();
                $location['state'] = array('opened' => true);
                try {
                    $station = EsiUtil::callESI($esi, 'get', '/universe/stations/{station_id}/', ['station_id' => $current->getLocation()]);

                    $location['text'] = $station->name;
                    $location['icon'] = CCPConfig::$imageServer . $station->type_id.'_32.png';

                } catch (EsiException $e) {
                    $location['text'] = 'Unknown station';

                }

                $results[] = $location;

            }
            else if($current->getLocationType() === "other" and $current->getLocationFlag() === "Hangar"){
                //Structure
                $location['id'] = $current->getLocation();
                try {
                    $station = EsiUtil::callESI($esi, 'get', '/universe/structures/{structure_id}/', ['structure_id' => $current->getLocation()]);

                    $location['text'] = $station->name;
                    $location['icon'] = CCPConfig::$imageServer . $station->type_id.'_32.png';

                } catch (EsiException $e) {
                    $location['text'] = 'Unknown location';
                }

                $results[] = $location;

            }
        }


        $resultsJson = array();
        foreach ($results as $result){
            $resultsJson = $this->addToFinal($resultsJson, $result);
        }



        return $this->json($resultsJson);

    }


    private function addToFinal($results, $toAdd)
    {

        $hasIt = false;

        foreach ($results as &$result) {

            if ($result['id'] === $toAdd['id']) {
                if (isset($result['children'])) {
                    if (!isset($toAdd['children']))
                        return $results;
                    $result['children'] = $this->addToFinal($result['children'], $toAdd['children'][0]);
                    $hasIt = true;
                }

            }

        }

        if (!$hasIt)
            $results[] = $toAdd;
        return $results;
    }


    /**
     * Get item information
     *
     * @Route("/search/system", name="search-system")
     */
    public function searchSystemAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $systemRep = $doctrine->getRepository(System::class);

        $systemName = '%' . $request->get('system'). '%';

        $query = $systemRep->createQueryBuilder('s');
        $systemsResult = $query->where($query->expr()->like('s.name', ':system'))->setParameter('system', $systemName)->getQuery()->execute();

        $systems = array();

        foreach ($systemsResult as $result){
            $systems[] = array('id' => $result->getId(), 'name' => $result->getName());
    }

        return $this->json(array('systems' => $systems));


    }

    /**
     * Get item information
     *
     * @Route("/ajax/route", name="get-route-ajax")
     */
    public function getRouteAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $routeRep = $doctrine->getRepository(\AppBundle\Entity\Route::class);

        $route = $routeRep->find($request->get('id'));


        return $this->json(array(
            'id' => $route->getId(),
            'price' => $route->getPrice(),
            'maxColat' => $route->getMaxColat(),
            'maxSize' => $route->getMaxSize(),
            'danger1b' => $route->getDanger1b(),
            'danger5b' => $route->getDanger5b(),
            'danger10b' => $route->getDanger10b(),
            'dangerMax' => $route->getDangerMax()
        ));

    }



}