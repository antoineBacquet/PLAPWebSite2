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
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use nullx27\ESI\Api\MarketApi;
use nullx27\ESI\Models\GetCharactersCharacterIdOrders200Ok;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Seat\Eseye\Exceptions\EsiScopeAccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{


    /**
     * This route de the profile page of a user
     *
     * @Route("/profile", name="profile")
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function profileAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        if($user->getMainApi() === null){
            $parameters['main_api'] = null;
        }
        else{
            $parameters['main_api'] = $user->getMainApi();
            try{
                $parameters['api_summary'] = UserUtil::getApiSummary($user->getMainApi(), $this->getDoctrine());
            }catch (EsiException $e){
                $parameters['esi_exception'] = $e;
                $parameters['api_summary'] = null; //TODO better error management
            }

        }

        $parameters['apis'] = $user->getApis();



        return $this->render('profile/index.html.twig', $parameters);

    }

    /**
     * This route de the profile page of a user
     *
     * @Route("/profile/mainapi/{id}", name="set_main_api")
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function profileMainApiAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $repApi = $this->getDoctrine()->getRepository(CharApi::class);
        /**
         * @var CharApi $api
         */
        $api = $repApi->find($id);


        if($api == null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }
        if($api->getUser()->getId() ==! $user->getId()){
            throw $this->createAccessDeniedException('Cette api ne t\'arpatient pas.');
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
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function myApisAction(Request $request){


        $parameters = ControllerUtil::before($this);


        $rep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * @var $apis array(CharApi)
         */
        $apis = $rep->findByUser($this->getUser());



        foreach($apis as $api) {

            /**
             * @var CharApi $api
             */
            CCPUtil::isApiValid($api, $this->getDoctrine()->getManager());

            //setting the esi api
            $esi = new Eseye();


            //portrait------------------------
            try {
                $api->portrait = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/portrait/', ['character_id' => $api->getCharId()])->px64x64;
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
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function myApiAction(Request $request, $id)
    {

        $parameters = ControllerUtil::before($this);


        $rep = $this->getDoctrine()->getRepository(CharApi::class);

        $user = $this->getUser();

        /**
         * @var CharApi $api
         */
        $api = $rep->find($id);

        if($api == null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }
        if($api->getUser() != $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Cette api ne t\'arpatient pas.');
        }

        if(CCPUtil::isApiValid($api, $this->getDoctrine()->getManager())){
            $parameters['api_summary'] = UserUtil::getApiSummary($api, $this->getDoctrine());
        }
        else{
            $parameters['api_summary'] = null;
        }

        return $this->render('profile/api.html.twig', $parameters);

    }

    /**
     * Basically generate the url to the ccp login page. This time with the scope needed.
     *
     * @Route("/profile/addapi", name="addapi")
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
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
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function ccpCallBackApiAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);


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
        if ($ch === false) {
            $parameters['message'] = "Imposible d'initialiser curl, réessaye.";
            return $this->render('error/login.html.twig', $parameters);
        }
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
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        curl_close($ch);


        $response = json_decode($result, true);
        if (isset($response['error'])) {
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        $access_token = $response['access_token'];
        $refresh_token = $response['refresh_token'];
        $ch = curl_init();
        if ($ch === false) {
            $parameters['message'] = "Imposible d'initialiser curl, réessaye.";
            return $this->render('error/login.html.twig', $parameters);
        }
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
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        curl_close($ch);
        $response = json_decode($result);
        if (!isset($response->CharacterID)) {
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        /*if (strpos(@$response->Scopes, 'publicData') === false) {
            throw $this->createNotFoundException('Error from ccp. The scopes don\'t match');
            //TODO Test on the scopes
        }*/


        $charID = (int)$response->CharacterID;


        $doctrine = $this->getDoctrine();
        $apiRep = $doctrine->getRepository(CharApi::class);

        $authentication = EsiUtil::getDefaultAuthentication($refresh_token);
        $esi = new Eseye($authentication);

        //character information-----------

        /**
         * @var $user User
         */
         $user = $this->getUser();

        try {
            $charInfo = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', ['character_id' => $charID]);
        } catch (EsiException $e) {
            $parameters['esi_exception'] = $e;
            return $this->render('error/esi.html.twig', $parameters);
        }

        /**
         * @var CharApi $api
         */
        $api = $apiRep->findOneByCharId($charID);


        if($api === null or $api->getUser() !==  $user)
            $api = new CharApi();


	    $expireOn = new \DateTime();
        $expireOn->add(new \DateInterval('PT1000S'));


        $api->setCharId($charID)->setCharName($charInfo->name)->setRefreshToken($refresh_token)
            ->setToken($access_token)
            ->setUser($this->getUser())
            ->setExpireOn($expireOn);

        try {
            $mails = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/mail/', ['character_id' => $charID]);
        } catch (EsiException $e) {
            $parameters['esi_exception'] = $e;
            return $this->render('error/esi.html.twig', $parameters);
        }



        if(count($mails)>0){

            if(isset($mails[0]))
                $api->setLastEmail($mails[0]->mail_id);
            else {
                $api->setLastEmail(0);
            }
        }
        else{
            $api->setLastEmail(0);
        }




        $doctrine->getManager()->persist($api);
        if($user->getMainApi() === null){
            $user->setMainApi($api);
            $doctrine->getManager()->persist($user);
        }

        $doctrine->getManager()->flush();

        return $this->redirect('/profile/apis');

    }

    /**
     * Remove an api
     *
     * @Route("/profile/removeapi/{id}", name="removeapi")
     * @Security("is_granted('ROLE_MEMBER') or is_granted('ROLE_APPLY')")
     */
    public function removeApiAction(Request $request, $id)
    {

        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();


        $rep = $this->getDoctrine()->getRepository(CharApi::class);
        $api = $rep->find($id);
        if($api === null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }
        if($api->getUser()->getId() ==! $user->getId() and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Cette api ne t\'arpatient pas.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($api);
        $em->flush();


        return $this->redirect('/profile/apis');

    }

    /**
     * Remove an api
     *
     * @Route("/profile/order", name="myorder")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function myOrderAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);

        //die('nop');

        //die('orders');
        $user = $this->getUser();
        $apis = $user->getApis();



        $form = $this->createFormBuilder()
            ->add('apis', ChoiceType::class,[
                'choices' => $apis
            ])
        ->getForm();
        $parameters['form'] = $form->createView();

        $orders = array();

        /**
         * @var $api CharApi
         */
        foreach ($apis as $api){
            $authentification = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
            $esi = new Eseye($authentification);

            try{
                $ordersTmp = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/orders/', array('character_id' => $api->getCharId()) );

                $orders = array_merge($orders, $ordersTmp->getArrayCopy());
            }
            catch (EsiException $e){
                $parameters['esi_exception'] = $e;
                return $this->render('error/esi.html.twig', $parameters);
            }
        }

        //dump($orders);
        //die('lel');
        return $this->render('profile/orders.html.twig', $parameters);

    }







    /**
     * Add a command
     *
     * @Route("/profile/commands", name="mycommands")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function myCommandAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $commandRep = $doctrine->getRepository(Command::class);

        $commands = $commandRep->findByIssuer($this->getUser());

        $parameters['commands'] = $commands;

        return $this->render('profile/commands.html.twig', $parameters);

    }

    /**
     * Remove an api
     *
     * @Route("/service/notification", name="notification")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function notificationAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $notification = $user->getNotification();

        if($notification === null){
            $notification = new Notification();
            $notification->setUser($user);
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
