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
use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Command;
use AppBundle\Entity\Notification;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use nullx27\ESI\Api\MarketApi;
use nullx27\ESI\Models\GetCharactersCharacterIdOrders200Ok;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Seat\Eseye\Exceptions\EsiScopeAccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{


    /**
     * This route de the profile page of a user
     *
     * @Route("/profile", name="profile")
     */
    public function profileAction(Request $request)
    {

        $parameters = ControllerUtil::before($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(isset($parameters['redirect'])) return $this->render($parameters['redirect_path'],$parameters);

        $user = UserUtil::getUser($this->getDoctrine(), $request);

        if($user->getMainApi() === null){
            $parameters['main_api'] = null;
        }
        else{
            $parameters['main_api'] = $user->getMainApi();
            try{
                $parameters['api_summary'] = UserUtil::getApiSummary($user->getMainApi(), $this->getDoctrine());
            }catch (EsiException $e){
                $parameters['esi_exception'] = $e;
                $parameters['api_summary'] = null;
            }

        }

        $parameters['apis'] = $user->getApis();



        return $this->render('profile/index.html.twig', $parameters);

    }

    /**
     * This route de the profile page of a user
     *
     * @Route("/profile/mainapi/{id}", name="set_main_api")
     */
    public function profileMainApiAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(isset($parameters['redirect'])) return $this->render($parameters['redirect_path'],$parameters);

        $user = UserUtil::getUser($this->getDoctrine(), $request);

        $repApi = $this->getDoctrine()->getRepository(CharApi::class);
        /**
         * @var CharApi $api
         */
        $api = $repApi->find($id);


        if($api == null){
            $parameters['message'] = 'Api trouvé dans la base de données';
            return $this->render('error/404.html.twig', $parameters);

        } //TODO error page
        if($api->getUser()->getId() ==! $user->getId()){
            $parameters['message'] = 'Cette api ne t\'arpatient pas.';
            return $this->render('error/forbidden.html.twig', $parameters);
        }

        $user->setMainApi($api);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('profile'));


    }



    /**
     * List every api of a user. One api per character
     *
     * @Route("/profile/apis", name="myapis")
     */
    public function myApisAction(Request $request){


        $parameters = ControllerUtil::before($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(isset($parameters['redirect'])) return $this->render($parameters['redirect_path'],$parameters);


        $rep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var $apis array(CharApi)
         */
        $apis = $rep->findByUser($parameters['user']->getId());



        foreach($apis as $api) {

            /**
             * @var CharApi $api
             */
            CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());
            //TODO if api is not valid

            //setting the esi api
            $esi = new Eseye();


            //portrait------------------------
            try {
                $api->portrait = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/portrait/', ['character_id' => $api->getCharId()])->px128x128;
            } catch (EsiException $e) {
                //TODO not found image
            }
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


        $parameters = ControllerUtil::before($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(isset($parameters['redirect'])) return $this->render($parameters['redirect_path'],$parameters);


        $rep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var CharApi $api
         */
        $api = $rep->find($id);


        //test if the API exist in the database, return an error page if not
        if($api == null){
            $parameters['message'] = "L'API n'existe pas.";
            return $this->render('template/404.html.twig', $parameters);
        }

        //if this not the user api or the user is not an admin return an error page
        if($api->getUser() != $parameters['user'] and !$parameters['user']->isAdmin){
            $parameters['message'] = "Tu n'es pas autorisé a voir ca.";
            return $this->render('template/forbidden.html.twig', $parameters);
        }

        CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());
        //TODO if api is not valid

        $parameters['api_summary'] = UserUtil::getApiSummary($api, $this->getDoctrine());


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

        $authentication = EsiUtil::getDefaultAuthentication($refresh_token);
        $esi = new Eseye($authentication);

        //character information-----------
        $charInfo = $esi->invoke('get', '/characters/{character_id}/', [
            'character_id' => $charID,
        ]);

        $api = new CharApi();
	    $expireOn = new \DateTime();
        $expireOn->add(new \DateInterval('PT1000S'));


        $api->setCharId($charID)->setCharName($charInfo->name)->setRefreshToken($refresh_token)
            ->setToken($access_token)
            ->setUser(UserUtil::getUser($this->getDoctrine(), $request))
            ->setExpireOn($expireOn);

        try {
            $mails = $esi->invoke('get', '/characters/{character_id}/mail/', [
                'character_id' => $api->getCharId()
            ]);
        } catch (EsiScopeAccessDeniedException $e) {
        }

        if(count($mails)>0){
            $api->setLastEmail($mails[0]->mail_id);
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

        die('orders');
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
