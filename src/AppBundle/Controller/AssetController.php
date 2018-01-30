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
use AppBundle\Entity\CharApi;
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
    public function adminGroupRemoveAction(Request $request)
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
        $api = $user->getApis()[0];

        $authentication = new EsiAuthentication([
            'client_id'     => CCPConfig::$clientIDAPI,
            'secret'        => CCPConfig::$secretKEYAPI,
            'refresh_token' => $api->getRefreshToken()
        ]);

        $esi = new Eseye($authentication);
        $portraits = $esi->invoke('get', '/characters/{character_id}/assets/', [
            'character_id' => $api->getCharId()
        ]);



        if(!CCPUtil::isApiValid($api, $this->getDoctrine()->getManager()))
            die('Token non valid');  //TODO error management




        die(var_dump($asset));

        die('asset test');
    }
}