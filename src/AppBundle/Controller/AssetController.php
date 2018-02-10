<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/01/2018
 * Time: 20:59
 */

namespace AppBundle\Controller;



use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\CCPUtil;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\Asset;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\GroupUtil;
use nullx27\ESI\Api\AssetsApi;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class AssetController extends Controller
{

    /**
     * Remove a group
     *
     * @Route("/asset/update", name="testasset")
     */
    public function assetUpdateAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        /**
         * @var User $user
         */
        $user = $parameters['user'];

        /**
         * @var CharApi $api
         */
        $api = $user->getApis()[0]; //TODO change that retard

        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($authentication);


        $em = $this->getDoctrine()->getManager();
        $assetRep = $em->getRepository(Asset::class);
        $itemRep = $em->getRepository(Item::class);

        //delete old asset
        $oldAset = $assetRep->findBy(array("owner" => $api));
        foreach ($oldAset as $old){
            $em->remove($old);
        }
        $em->flush();

        $assetData = array();
        $page = 1;

        do{
            $esi->setQueryString(['page' => $page]);
            $assetTmp = $esi->invoke('get', '/characters/{character_id}/assets/', [
                'character_id' => $api->getCharId(),
            ]);

            foreach ($assetTmp->getArrayCopy() as $tmp){
                $assetData[] = $tmp;
                //echo $tmp->item_id . ' Type : ' . $tmp->type_id . '<br>';
            }
            $page = $page + 1;

        }while(count($assetTmp->getArrayCopy())>0);

        //die('lel' . count($assetData));





        foreach ($assetData as $asset){
            $assetDB = new Asset();
            $assetDB->setId($asset->item_id)
                ->setOwner($api)
                ->setItem($itemRep->find($asset->type_id))
                ->setLocation($asset->location_id)
                ->setQuantity($asset->quantity)
                ->setLocationFlag($asset->location_flag)
                ->setLocationType($asset->location_type);
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
                echo 'has parent';
                $asset->setParent($parent);
                $em->persist($asset);
            }
        }

        $em->flush();



        //die(var_dump($asset));

        die('asset test');
    }

    /**
     *
     *
     * @Route("/asset", name="asset")
     */
    public function assetAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $user = $parameters['user'];

        /**
         * @var CharApi $api
         */
        $api = $user->getApis()[0]; //TODO change that retard

        $em = $this->getDoctrine()->getManager();
        $assetRep = $em->getRepository(Asset::class);

        $assets = $assetRep->findByOwner($api);

        $i=0;
        foreach ($assets as $asset){
            if($asset->getParent() !== null)
                unset($assets[$i]);

            $i = $i+1;
        }

        $parameters['assets'] = $assets;

        return $this->render('asset/test.html.twig', $parameters);


    }
}