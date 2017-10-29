<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 29/10/2017
 * Time: 13:22
 */

namespace AppBundle\Controller;

use AppBundle\CCP\CCPConfig;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\Core;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{

    /**
     *
     * This route is the homepage idiot
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request);



        return $this->render('default/index.html.twig', $parameters);
        //
    }

    /**
     *
     * Basically generate the url to the ccp login page.
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
        $url = $url . '&scope=publicData'; //no scope needded -- publicData+esi-wallet.read_character_wallet.v1
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

        $parameters = Core::getDefaultParameter($this->getDoctrine(), $request);
        $parameters['base_dir'] = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        if($request->getSession()){
            $request->getSession()->clear();
            $request->getSession()->invalidate(0);
        }
        //

        return $this->redirect($this->generateUrl('homepage'));
    }

}