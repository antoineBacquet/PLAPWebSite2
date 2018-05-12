<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 29/10/2017
 * Time: 13:22
 */

namespace AppBundle\Controller;

use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\EsiException;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\Core;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class MainController extends Controller
{

    /**
     *
     * This route is the homepage
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);


        return $this->render('default/index.html.twig', $parameters);
        //
    }

    /**
     *
     * This route generate the url to the ccp login page.
     *
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $url = CCPConfig::$loginURL; //url de base de connection
        $url = $url . '?';
        $url = $url . 'response_type=code'; // le type de connection, on need un code pour generer un token aprés
        $url = $url . '&client_id=' . CCPConfig::$clientID;
        $url = $url . '&redirect_uri='.CCPConfig::$redirectUrl ;
        $url = $url . '&scope=publicData'; //no scope needed
        $url = $url . '&state=ajmzoeijapoziepaize'; //TODO random


        return $this->redirect($url);


    }

    /**
     * this route logout the user
     *
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        return $this->redirect($this->generateUrl('homepage'));
    }


    /**
     * This route manage the redirection after login on ccp server, create the session and user
     *
     * @Route("/ccpcallback", name="ccpCallBack")
     */
    public function ccpCallBackAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);


        $userAgent = 'PLAPWebsite';


        //Getting a token and refresh from ccp with the code-----------------------------------
        $header = 'Authorization: Basic ' . base64_encode(CCPConfig::$clientID . ':' . CCPConfig::$secretKEY);
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

        //echo curl_getinfo($ch) . '<br/>';
        //echo curl_errno($ch) . '<br/>';
        //echo curl_error($ch) . '<br/>';

        curl_close($ch);
        if ($result === false) {
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }

        $response = json_decode($result, true);
        if (isset($response['error'])) {
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        $access_token = $response['access_token'];
        //-----------------------------------------------------------------------------------------


        //getting the char id from ccp and testing if the token is good----------------------------
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
        if (strpos(@$response->Scopes, 'publicData') === false) {
            $parameters['message'] = "Erreur inconnue venant de CCP (CCPLZ).";
            return $this->render('error/login.html.twig', $parameters);
        }
        $charID = (int)$response->CharacterID;
        //-----------------------------------------------------------------------------------------



        $doctrine = $this->getDoctrine();

        //creating the user in the database if necessary
        if (!UserUtil::userExist($charID, $doctrine)) {
            try {
                UserUtil::addUser($doctrine, $charID);
            }
            catch (EsiException $e){
                $parameters['esi_exception'] = $e;
                return $this->render('error/esi.html.twig', $parameters);
            }

        }

        $user = UserUtil::getUser($doctrine,$charID);

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());

        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);


        if(UserUtil::hasRole($user, 'ROLE_MEMBRE')){
            return $this->redirect($this->generateUrl('profile'));
        }
        else{
            return $this->redirect('/'); //TODO redirect to recruitment page
        }
    }



    /**
     * Test stuff here
     *
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)
    {

        die('what are you looking for?');

    }

}