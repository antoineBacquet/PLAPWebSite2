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
use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\UserUtil;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                    //TODO error management
                }
                //TODO message de feedback
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
