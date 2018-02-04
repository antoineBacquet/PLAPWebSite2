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
use AppBundle\CCP\EsiUtil;
use AppBundle\CCP\TokenData;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Command;
use AppBundle\Entity\Item;
use AppBundle\Entity\Notification;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use nullx27\ESI\Api\CharacterApi;
use nullx27\ESI\Api\MarketApi;
use nullx27\ESI\Api\MailApi;
use nullx27\ESI\Api\WalletApi;
use nullx27\ESI\Models\GetCharactersCharacterIdOrders200Ok;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Seat\Eseye\Exceptions\EsiScopeAccessDeniedException;
use Seat\Eseye\Exceptions\RequestFailedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            $api->isValid = CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());
            //TODO if api is not valid

            //setting the esi api
            $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
            $esi = new Eseye($authentication);



            //portrait------------------------
            $api->portrait = $esi->invoke('get', '/characters/{character_id}/portrait/', [
                'character_id' => $api->getCharId(),
            ])->px64x64;
            //--------------------------------



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


        //test if the API exist in the database, return an error page if not
        if($api == null){
            $parameters['message'] = "L'API n'existe pas.";
            return $this->render('template/error.html.twig', $parameters);
        }

        //if this not the user api or the user is not an admin return an error page
        if($api->getUser() != $parameters['user'] and !$parameters['user']->isAdmin){
            $parameters['message'] = "Tu n'es pas autorisé a voir ca.";
            return $this->render('template/error.html.twig', $parameters);
        }

        $api->isValid = CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());
        //TODO if api is not valid


        //setting the esi api
        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($authentication);

        //character information-----------
        $charInfo = $esi->invoke('get', '/characters/{character_id}/', [
            'character_id' => $api->getCharId(),
        ]);
        //--------------------------------



        //portrait------------------------
        $portrait = $esi->invoke('get', '/characters/{character_id}/portrait/', [
            'character_id' => $api->getCharId(),
        ])->px128x128;
        $parameters['portrait'] = $portrait;
        //--------------------------------


        //corp----------------------------
        $corp = $esi->invoke('get', '/corporations/{corporation_id}/', [
            'corporation_id' => $charInfo->corporation_id,
        ])->name;
        $parameters['corp'] = $corp;
        //--------------------------------

        //corp history--------------------
        $corpsHistory = $esi->invoke('get', '/characters/{character_id}/corporationhistory/', [
            'character_id' => $api->getCharId(),
        ])->getArrayCopy();
        $lastCorp = current($corpsHistory);


        $now = new \DateTime();
        $startDate = new \DateTime($lastCorp->start_date);

        $joined = $now->diff($startDate)->format("%a");
        $parameters['joined'] = $joined;
        //--------------------------------

        //skillpoints---------------------
        $skillpoints = $esi->invoke('get', '/characters/{character_id}/skills/', [
            'character_id' => $api->getCharId(),
        ])->total_sp;
        $parameters['skillpoints'] = $skillpoints;
        //--------------------------------

        //wallet--------------------------
        $wallet = $esi->invoke('get', '/characters/{character_id}/wallet/', [
            'character_id' => $api->getCharId(),
        ]);
        $parameters['wallet'] = $wallet->getArrayCopy()['scalar'];
        //--------------------------------

        //current ship--------------------
        $currentShip = $esi->invoke('get', '/characters/{character_id}/ship/', [
            'character_id' => $api->getCharId(),
        ]);
        $itemRep = $this->getDoctrine()->getRepository(Item::class);

        $parameters['current_ship']['type'] = $itemRep->find($currentShip->ship_type_id)->getName();
        $parameters['current_ship']['name'] = $currentShip->ship_name;
        //--------------------------------

        //location------------------------
        $location = $esi->invoke('get', '/characters/{character_id}/location/', [
            'character_id' => $api->getCharId(),
        ]);

        //station
        if(isset($location->station_id)){
            $parameters['location']['type'] = 'station';

            $station = $esi->invoke('get', '/universe/stations/{station_id}/', [
                'station_id' => $location->station_id,
            ]);

            $parameters['location']['name'] = $station->name;
        }
        //citadel
        else if(isset($location->structure_id)){
            $parameters['location']['type'] = 'citadel';

            $structure = null;
                try{
                    $structure = $esi->invoke('get', '/universe/structures/{structure_id}/', [
                        'structure_id' => $location->structure_id,
                    ]);

                    $parameters['location']['name'] = $structure->name;
                    //TODO System name
                }
                catch (EsiScopeAccessDeniedException $e){

                }
                catch (RequestFailedException $e){

                }
        }

        //dans l'espsace
        else{
            $parameters['location']['type'] = 'space';
        }

        //security status-----------------
        $parameters['security_status'] = $charInfo->security_status;

        //--------------------------------


        $parameters['api'] = $api;



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

        $esi = new CharacterApi(); //TODO replace with new API

        $charInfo = $esi->getCharactersCharacterId($charID);

        $api = new CharApi();
	    $expireOn = new \DateTime();
        $expireOn->add(new \DateInterval('PT1000S'));


        $api->setCharId($charID)->setCharName($charInfo->getName())->setRefreshToken($refresh_token)
            ->setToken($access_token)
            ->setUser(UserUtil::getUser($this->getDoctrine(), $request))
            ->setExpireOn($expireOn);

        $mailEsi = new MailApi();



        $mails = $mailEsi->getCharactersCharacterIdMail($charID, CCPConfig::$datasource, null, null, $access_token); //TODO replace with nex API

        if(count($mails)>0){
            $api->setLastEmail($mails[0]->getMailId());
        }
        else{
            $api->setLastEmail(0);
        }


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

    /**
     * Remove an api
     *
     * @Route("/service/notification", name="notification")
     */
    public function notificationAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $notification = $parameters['user']->getNotification();

        if($notification === null){
            $notification = new Notification();
            $notification->setUser($parameters['user']);
        }

        $form = $this->createFormBuilder($notification)
            ->add('emailNotification', CheckboxType::class, array('required' => false, 'label' => 'Notification Eve-Mail '))
            ->add('save', SubmitType::class, array('label' => 'Valider'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
        }

        $parameters['form'] = $form->createView();


        return $this->render('profile/notification.html.twig', $parameters);

    }






}
