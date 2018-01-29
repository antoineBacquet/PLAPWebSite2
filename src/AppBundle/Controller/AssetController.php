<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/01/2018
 * Time: 20:59
 */

namespace AppBundle\Controller;



use AppBundle\Entity\User;
use nullx27\ESI\Api\AssetsApi;
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
    public function adminGroupRemoveAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        /**
         * @var User $user
         */
        $user = $parameters['user'];

        $api = $user->getApis()[0];

        $assetEsi = new AssetsApi();
        $assetEsi->getCharactersCharacterIdAssets($apis[0]->get);


        die('asset test');
    }
}