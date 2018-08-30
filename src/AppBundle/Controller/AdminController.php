<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 17:55
 */

namespace AppBundle\Controller;


use AppBundle\CCP\CCPUtil;
use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Command;
use AppBundle\Entity\Recruitement;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\UserUtil;
use AppBundle\Util\Util;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class AdminController
 * @package AppBundle\Controller
 *
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{


    /**
     * @Route("/members", name="members")
     */
    public function adminMemberListAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);


        $rep = $this->getDoctrine()->getRepository(User::class);

        $users = $rep->findAll();

        $esi = new Eseye();



        foreach ($users as $user){

            try {
                $corp = EsiUtil::callESI($esi, 'get', '/corporations/{corporation_id}/', array('corporation_id' => $user->getCorpId()));
            }
            catch (EsiException $e){
                $corp = null;
            }

            $user->corp = $corp;
        }


        $parameters['members'] = $users;
        return $this->render('admin/members.html.twig', $parameters);

    }

    /**
     * @Route("/member/remove/{id}", name="member-remove")
     */
    public function adminMemberRemoveAction(Request $request, User $member)
    {
        ControllerUtil::before($this);

        $this->getDoctrine()->getManager()->remove($member);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('members'));

    }

    /**
     * @Route("/members/missing", name="members-missing")
     */
    public function adminMemberMissingListAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);

        $em = $this->getDoctrine()->getManager();
        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);

        /**
         * User $user
         */
        $user = $this->getUser();

        $api = $user->getApis()[0]; //TODO error management


        $auth = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($auth);

        $membersId = EsiUtil::callESI($esi, 'get', '/corporations/{corporation_id}/members/', array('corporation_id' => Util::$corpId));

        $missingApis = array();

        foreach ($membersId as $id){

            $apiTmp = $apiRep->findOneByCharId($id);
            if($apiTmp == null){
                $memberData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $id));
                $memberData->id = $id;
                $missingApis[] = $memberData;
            }
        }


        $parameters['missingApis'] = $missingApis;

        return $this->render('admin/members-missing.html.twig', $parameters);

    }


    /**
     * @Route("/member/{id}", name="member")
     */
    public function adminMemberAction(Request $request, $id)
    {

        $parameters = ControllerUtil::before($this);


        $doctrine = $this->getDoctrine();
        $userRep = $doctrine->getRepository(User::class);
        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);


        /**
         * @var User $user
         */
        $user = $userRep->find($id);

        if($user == null){
            throw  $this->createNotFoundException("Le membre n'existe pas.");
        }


        $apis = $apiRep->findByUser($user);

        foreach($apis as $api){
            CCPUtil::isApiValid($api, $doctrine->getManager());


            $esi = new Eseye();

            try {
                $portraits = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/portrait/', array('character_id' => $api->getCharId()));
            }
            catch (EsiException $e){
                $portraits = null; //TODO not found image
            }

            $api->portrait = $portraits->px64x64;
        }


        $groupForm = $this->createFormBuilder($user)
            ->add('Roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true, // render check-boxes
                'choices' => UserUtil::$roleMapping,
            ])
            ->add('save', SubmitType::class, array('label' => 'Changer les roles',  'attr' => array(
                'class' => 'btn-admin')))
            ->getForm();


        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            dump($groupForm->getData()->GetRoles());
            $user->setRoles( $groupForm->getData()->GetRoles());

            $doctrine->getManager()->persist($user);
            $doctrine->getManager()->flush();

            if($user->getDiscordId() != null){
                $webhook = new Client(DiscordConfig::$webhook_url);
                $embed = new Embed();

                $embed->description('Demande de mise a jour des roles');

                try{
                    $webhook->username('Bot')->message('!ur <@' . $user->getDiscordId() .'>')->embed($embed)->send();
                }
                catch (\Exception $e){
                    $parameters['feedback'] = false;
                    $parameters['error'] = $e;
                }
                $parameters['feedback'] = true;
            }
        }

        $commandRep = $doctrine->getRepository(Command::class);
        $commands = $commandRep->findBy(array('issuer' => $user), array('id' => 'DESC'));


        $parameters['commands'] = $commands;
        $parameters['member'] = $user;
        $parameters['apis'] = $apis;
        $parameters['group_form']  = $groupForm->createView();

        return $this->render('admin/member.html.twig', $parameters);


    }

    /**
     * @Route("/admin/apply", name="apply-list")
     */
    public function adminApplyListAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);

        $applyRep = $this->getDoctrine()->getRepository(Recruitement::class);

        $applys = $applyRep->findAll();

        $esi = new Eseye();
        foreach ($applys as $apply){

            try {
                $corp = EsiUtil::callESI($esi, 'get', '/corporations/{corporation_id}/', array('corporation_id' => $apply->getUser()->getCorpId()));
            }
            catch (EsiException $e){
                $corp = null;
            }

            $apply->getUser()->corp = $corp;
        }

        $parameters['applys'] = $applys;

        return $this->render('admin/apply.html.twig', $parameters);
    }

    /**
     * @Route("/admin/apply/remove/{id}", name="apply-remove")
     * @ParamConverter(name="apply")
     */
    public function adminApplyRemoveAction(Request $request, Recruitement $apply)
    {
        $parameters = ControllerUtil::before($this);

        $em = $this->getDoctrine()->getManager();

        $apply->getUser()->removeRole('ROLE_APPLY');
        $em->persist($apply->getUser());

        $em->remove($apply);
        $em->flush();

        return $this->redirect($this->generateUrl('apply-list'));
    }

    /**
     * @Route("/admin/apply/{id}", name="apply-info")
     */
    public function adminApplyAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        $applyRep = $this->getDoctrine()->getRepository(Recruitement::class);

        $apply = $applyRep->find($id);
        $esi = new Eseye();
        try {
            $corp = EsiUtil::callESI($esi, 'get', '/corporations/{corporation_id}/', array('corporation_id' => $apply->getUser()->getCorpId()));
        }
        catch (EsiException $e){
            $corp = null;
        }
        $apply->getUser()->corp = $corp;

        $parameters['apply'] = $apply;

        return $this->render('admin/apply-info.html.twig', $parameters);
    }






        /**
     * @Route("/admin/emails/{id}", name="emails")
     */
    /*public function adminMemberEmailsAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;




        $api = new MailApi();

        $api->getCharactersCharacterIdMail($user->getCharId(), CCPConfig::$datasource);


    }*/







}
