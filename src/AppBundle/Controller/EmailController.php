<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 15/11/2017
 * Time: 22:29
 */

namespace AppBundle\Controller;

use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\User;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Util\ControllerUtil;

class EmailController extends Controller
{


    /**
     * List every email
     *
     * @Route("/profile/email", name="emailsmenu")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function emailsMenuAction(Request $request, User $user = null)
    {

        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $apiRep = $doctrine->getRepository(CharApi::class);


        if($user === null){
            $user = $this->getUser();
        }

        $apis = $apiRep->findByUser($user);

        /**
         * @var CharApi $api
         */
        foreach($apis as $api){


            $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());

            $esi = new Eseye($authentication);

            try {
                $labels = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/mail/labels/', array('character_id' => $api->getCharId()));
            }
            catch (EsiException $e){
                $parameters['esi_exception'] = $e;
                return $this->render('error/esi.html.twig', $parameters);
            }


            $api->unread  = $labels->total_unread_count;
        }


        $parameters['apis'] = $apis;

        return $this->render('email/emailsmenu.html.twig', $parameters);
    }


    /**
     * List every email
     *
     * @Route("/admin/email/{id]", name="emailsMenuAdmin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function emailsMenuAdminAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        $userRep = $this->getDoctrine()->getRepository(User::class);

        $user = $userRep->find($id);

        if($user === null){
            throw $this->createNotFoundException("Utilisateur non trouvé dans la base de données");
        }

        return $this->emailsMenuAction($request, $user);
    }

    /**
     * List every email
     *
     * @Route("/profile/emails/{id}", name="emailsNoLabel")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function myEmailsNoLabelAction(Request $request, $id)
    {

        return $this->myEmailsAction($request, $id, 1);
    }

    /**
     * List every email
     *
     * @Route("/profile/emails/{id}/label/{label_id}", name="emails")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function myEmailsAction(Request $request, $id, $label_id)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $doctrine = $this->getDoctrine();
        $apiRep = $doctrine->getRepository(CharApi::class);

        /**
         * @var CharApi $api
         */
        $api = $apiRep->find($id);
        $parameters['api'] = $api;


        if($api === null){
            throw $this->createNotFoundException("Api non trouvé dans la base de données");
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Cette api ne t\'apartient pas!');
        }

        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());

        $esi = new Eseye($authentication);


        try {
            $labels = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/mail/labels/', array('character_id' => $api->getCharId()));
        }
        catch (EsiException $e){
            $parameters['esi_exception'] = $e;
            return $this->render('error/esi.html.twig', $parameters);
        }

        $parameters['labels'] = $labels->getArrayCopy();

        try{
            $emails = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/mail/', array('character_id' => $api->getCharId()), array('labels' => $label_id));
        }
        catch (EsiException $e) {
            $parameters['esi_exception'] = $e;
            return $this->render('error/esi.html.twig', $parameters);
        }


        //TODO multithread that
        foreach ($emails as $email){
            try{
                $from = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $email->from));
                $email->from = $from->name;
            }
            catch (EsiException $e){

            }
        }

        $parameters['emails'] = $emails->getArrayCopy();

        return $this->render('profile/emails.html.twig', $parameters);

    }

    /**
     * Show an email
     *
     * @Route("/profile/email/{id_api}/{id_email}", name="email")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function emailAction(Request $request, $id_api, $id_email)
    {

        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $doctrine = $this->getDoctrine();
        $apiRep = $doctrine->getRepository(CharApi::class);

        $api = $apiRep->find($id_api);
        $parameters['api'] = $api;

        if($api === null){
            throw $this->createNotFoundException("Api non trouvé dans la base de données");
        }

        if($api->getUser() !== $user and !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('Cette api ne t\'apartient pas!');
        }

        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());

        $esi = new Eseye($authentication);

        $email = null;
        try{
            $email = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/mail/{mail_id}/', array('character_id' => $api->getCharId(), 'mail_id' => $id_email));
        }
        catch (EsiException $e){
            $parameters['esi_exception'] = $e;
            return $this->render('error/esi.html.twig', $parameters);
        }

        try{
            $from = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $email->from));
            $email->from = $from->name;
        }
        catch (EsiException $e){
            $email->from = 'Inconnue (Erreur ESI)';
        }


        $matches = null;
        //$systemPatern = '/<a href="showinfo:(\d{1})//(\d*)">(\w*)</a>/';

        //die($email->body);

        //Patern to be found

        $fontPatern = "/<font size=\"(\d*)\" color=\"#([abcdef0-9]*)\">/";
        $email->body = preg_replace($fontPatern, '<font color="#\2">', $email->body);

        $charPatern = "/<a href=\"showinfo:(1377|1386)\/\/(\d*)\">([^<]*)<\/a>/"; //1377
        $corpPatern = "/<a href=\"showinfo:2\/\/(\d*)\">([^<]*)<\/a>/"; //2
        $alliancePatern = "/<a href=\"showinfo:16159\/\/(\d*)\">([^<]*)<\/a>/"; //16159

        $systemPatern = "/<a href=\"showinfo:5\/\/(\d*)\">([^<]*)<\/a>/"; //5
        $stationPatern = "/<a href=\"showinfo:3869\/\/(\d*)\">([^<]*)<\/a>/"; //5

        $killPatern = "/<a href=\"killReport:(\d*):([a-z0-9]*)\">([^<]*)<\/a>/";


        //systems----------------------------------------------------------
        $systemsFound = array();

        preg_match_all($systemPatern, $email->body, $systemsFound);

        for( $i = 0 ; $i < count($systemsFound[0]) ; $i++){

            try{
                $systemNameData = EsiUtil::callESI($esi, 'get', '/universe/systems/{system_id}/', array('system_id' => $systemsFound[1][$i]));
                $systemName = $systemNameData->name;
            }
            catch (EsiException $e){
                $systemName = 'Systeme inconnue (erreur ESI)';
            }

            $replace = '<a href="http://evemaps.dotlan.net/system/' . $systemName . '">' . $systemsFound[2][$i] . '</a>';

            $email->body = str_replace($systemsFound[0][$i],$replace , $email->body);
        }
        //-----------------------------------------------------------------------

        //character----------------------------------------------------------
        $charsFound = array();

        preg_match_all($charPatern, $email->body, $charsFound);

        //die(var_dump($charsFound));

        for( $i = 0 ; $i < count($charsFound[0]) ; $i++){

            try{
                $charNameData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $charsFound[2][$i]));
                $charName = $charNameData->name;
            }
            catch (EsiException $e){
                $charName = 'Nom inconnue (erreur ESI)';
            }

            $charName = str_replace(' ', '+', $charName);

            $replace = '<a href="https://evewho.com/pilot/' . $charName . '">' . $charsFound[3][$i] . '</a>';

            $email->body = str_replace($charsFound[0][$i],$replace , $email->body);
        }
        //-----------------------------------------------------------------------

        //corporation
        $email->body = preg_replace($corpPatern, '<a href="http://evemaps.dotlan.net/corp/\1">\2</a>', $email->body);

        $email->body = preg_replace($alliancePatern, '<a href="http://evemaps.dotlan.net/alliance/\1">\2</a>', $email->body);

        $email->body = preg_replace($stationPatern, '<a href="http://evemaps.dotlan.net/station/\1">\2</a>', $email->body);

        $email->body = preg_replace($killPatern, '<a href="https://zkillboard.com/kill/\1">\3</a>', $email->body);


        $parameters['email'] = $email;

        return $this->render('profile/email.html.twig', $parameters);


    }

}