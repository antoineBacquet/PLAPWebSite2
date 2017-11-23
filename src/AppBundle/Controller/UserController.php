<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 29/10/2017
 * Time: 13:51
 */

namespace AppBundle\Controller;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\CCPUtil;
use AppBundle\CCP\TokenData;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Command;
use AppBundle\Entity\CommandItem;
use AppBundle\Entity\Item;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\DiscordUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use nullx27\ESI\Api\CharacterApi;
use nullx27\ESI\Api\MarketApi;
use nullx27\ESI\Api\WalletApi;
use nullx27\ESI\Models\GetCharactersCharacterIdOrders200Ok;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Date;

class UserController extends Controller
{


    /**
     * This route de the profile page of a user
     *
     * @Route("/profile", name="profile")
     */
    public function profileAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;



        return $this->render('profile/index.html.twig', $parameters);

    }


    /**
     * List every api of a user. One api per character
     *
     * @Route("/profile/apis", name="myapis")
     */
    public function myApisAction(Request $request){


        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        $rep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var $apis array(CharApi)
         */
        $apis = $rep->findByUser($parameters['user']->getId());

        $charEsi = new CharacterApi();


        foreach($apis as $api){

            /**
             * @var CharApi $api
             */

            $tokenData = new TokenData($api->getToken(), $api->getRefreshToken());
            if(CCPUtil::isTokenValid($tokenData)){
                $api->isValid = true;
            }
            else{
                $tokenData = CCPUtil::updateToken($tokenData);
                if( $tokenData == false){
                    $api->isValid = false;
                }
                else{
                    $api->isValid = true;

                    $api->setToken($tokenData->token);
                    $api->setRefreshToken($tokenData->refreshToken);
                    $this->getDoctrine()->getManager()->flush();

                }
            }

            $api->portrait = $charEsi->getCharactersCharacterIdPortrait($api->getCharId())->getPx64x64();



        }


        $parameters['apis'] = $apis;

        return $this->render('profile/apis.html.twig', $parameters);

    }


    /**
     * Show information from an api
     *
     * @Route("/profile/api/{id}", name="myapi")
     */
    public function myApiAction(Request $request, $id){


        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        $rep = $this->getDoctrine()->getRepository(CharApi::class);


        /**
         * @var CharApi $api
         */
        $api = $rep->find($id);
        if($api->getUser() != $parameters['user'] and !$parameters['user']->isAdmin){
            die('you can\'t see that'); //TODO better
        }

        $charEsi = new CharacterApi();


        $api->isValid = CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());


        $api->portrait = $charEsi->getCharactersCharacterIdPortrait($api->getCharId())->getPx64x64();

        /*$configuration = Configuration::getInstance();
        $configuration->cache = NullCache::class;*/

        $authentication = new EsiAuthentication([
            'client_id'     => CCPConfig::$clientIDAPI,
            'secret'        => CCPConfig::$secretKEYAPI,
            'refresh_token' => $api->getRefreshToken()
        ]);

        $esi = new Eseye($authentication);
        $wallet = $esi->invoke('get', '/characters/{character_id}/wallet/', [
            'character_id' => $api->getCharId(),
        ]);

        $parameters['api'] = $api;

        $parameters['wallet'] = $wallet->getArrayCopy()['scalar'];

        $fatigueData = $esi->invoke('get', '/characters/{character_id}/fatigue/', [
            'character_id' => $api->getCharId(),
        ]);

        $fatigueDate = new \DateTime($fatigueData->jump_fatigue_expire_date);
        if($fatigueDate < (new \DateTime())){
            $fatigueDate = "Pret a jump";
        }
        else{
            $fatigueDate = $fatigueDate->format('Y-m-d H:i:s');
        }


        $parameters['fatigue'] = $fatigueDate;

        return $this->render('profile/api.html.twig', $parameters);

    }

    /**
     * Basically generate the url to the ccp login page. This time with the scope needed.
     *
     * @Route("/profile/addapi", name="addapi")
     */
    public function addApiAction(Request $request)
    {
        $url = CCPConfig::$loginURL; //url de base de connection
        $url = $url . '?';
        $url = $url . 'response_type=code'; // le type de connection, on need un code pour generer un token aprés
        $url = $url . '&client_id=' . CCPConfig::$clientIDAPI;
        $url = $url . '&redirect_uri='.CCPConfig::$redirectUrlAPI ;
        $url = $url . '&scope=' . CCPConfig::$scopes;
        $url = $url . '&state=ajmzoeijapoziepaize'; //TODO random


        return $this->redirect($url);

    }

    /**
     * This route manage the redirection after login on ccp server, create a CharacterApi and add this to the database
     *
     * @Route("/profile/ccpcallback", name="ccpcallbackapi")
     */
    public function ccpCallBackApiAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        $userAgent = 'PLAP';

        $header = 'Authorization: Basic ' . base64_encode(CCPConfig::$clientIDAPI . ':' . CCPConfig::$secretKEYAPI);
        $fields_string = '';
        $fields = array(
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
        );
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, CCPConfig::$tokenURL);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        if ($result === false) {
            throw $this->createNotFoundException('Error from ccp. No response');
        }
        curl_close($ch);


        $response = json_decode($result, true);
        if (isset($response['error'])) {
            throw $this->createNotFoundException('Error from ccp. Error message : ' . $response['error']);
        }
        $access_token = $response['access_token'];
        $refresh_token = $response['refresh_token'];
        $ch = curl_init();
        // Get the Character details from SSO
        $header = 'Authorization: Bearer ' . $access_token;
        curl_setopt($ch, CURLOPT_URL, CCPConfig::$verifyURL);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        if ($result === false) {
            throw $this->createNotFoundException('Error from ccp. (no response)');
        }
        curl_close($ch);
        $response = json_decode($result);
        if (!isset($response->CharacterID)) {
            throw $this->createNotFoundException('Error from ccp. Can\'t get the character id');
        }
        /*if (strpos(@$response->Scopes, 'publicData') === false) {
            throw $this->createNotFoundException('Error from ccp. The scopes don\'t match');
            //TODO Test on the scopes
        }*/


        $charID = (int)$response->CharacterID;


        $doctrine = $this->getDoctrine();

        $esi = new CharacterApi();

        $charInfo = $esi->getCharactersCharacterId($charID);

        $api = new CharApi();
        $api->setCharId($charID)->setCharName($charInfo->getName())->setRefreshToken($refresh_token)->setToken($access_token)->setUser(UserUtil::getUser($this->getDoctrine(), $request));

        $doctrine->getManager()->persist($api);
        $doctrine->getManager()->flush();

        return $this->redirect('/profile/apis');

    }

    /**
     * Remove an api
     *
     * @Route("/profile/removeapi/{id}", name="removeapi")
     */
    public function removeApiAction(Request $request, $id)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        $user = UserUtil::getUser($this->getDoctrine(), $request);
        $rep = $this->getDoctrine()->getRepository(CharApi::class);
        $api = $rep->find($id);
        if( $api == null)  return $this->redirect('/profile/api');

        if($api->getUser()->getId() != $user->getId()) return $this->redirect('/');

        $em = $this->getDoctrine()->getManager();
        $em->remove($api);
        $em->flush();
        return $this->redirect('/profile/apis');


    }

    /**
     * Remove an api
     *
     * @Route("/profile/order", name="myorder")
     */
    public function myOrderAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;
        $user = UserUtil::getUser($this->getDoctrine(), $request);

        $apis = $user->getApis();

        $eveApi = new MarketApi();

        $orders = array();
        /**
         * @var $api CharApi
         */
        foreach ($apis as $api){
            $eveApi->
            $orders = array_merge($orders, $eveApi->getCharactersCharacterIdOrders($api->getCharId(), CCPConfig::$datasource, $api->getToken()));
        }

        /**
         * @var $order GetCharactersCharacterIdOrders200Ok
         */
        foreach ($orders as $order){
            echo 'Type : ' . $order->getTypeId() . ', price : ' . $order->getPrice();
        }

    }


    /**
     * Remove an api
     *
     * @Route("/service/discord", name="discordservice")
     */
    public function serviceAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        return $this->render('profile/service.html.twig', $parameters);

    }

    /**
     * Remove an api
     *
     * @Route("/service/discord/updateroles", name="updatemyroles")
     */
    public function updateMyRolesAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        DiscordUtil::updateRoles(UserUtil::getUser($this->getDoctrine(),$request)); //TODO error management

        return $this->redirect($this->generateUrl('discordservice'));

    }








    /**
     * Add a command
     *
     * @Route("/profile/commands", name="mycommands")
     */
    public function myCommandAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        $commands = $commandRep->findByIssuer($parameters['user']);

        $parameters['commands'] = $commands;

        return $this->render('profile/commands.html.twig', $parameters);

    }






}