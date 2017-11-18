<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 17:55
 */

namespace AppBundle\Controller;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\CCPUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Groupe;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\Core;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use nullx27\ESI\Api\CharacterApi;
use nullx27\ESI\Api\CorporationApi;
use nullx27\ESI\Api\MailApi;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{

    /**
     * Remove a group
     *
     * @Route("/admin/group/remove/{id}", name="groupRemove")
     */
    public function adminGroupRemoveAction(Request $request, $id)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;


        //TODO some group should not be removed (user, admin, etc);

        $repository = $this->getDoctrine()->getRepository(Groupe::class);

        $group = $repository->find($id);

        if($group){
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('group'));
        //die('remove group');
    }


    /**
     * Show the group list, and handle the addition of group
     *
     * @Route("/admin/group", name="group")
     */
    public function adminGroupAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Groupe::class);



        $groupe = new Groupe();
        $form = $this->createFormBuilder($groupe)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Ajouter groupe'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newGroupe = $form->getData();

            $doctrine->getManager()->persist($newGroupe);
            $doctrine->getManager()->flush();
        }

        $groups = $repository->findAll();

        $parameters['groups'] = $groups;
        $parameters['form'] = $form->createView();

        return $this->render('admin/groupListe.html.twig', $parameters);


    }

    /**
     * @Route("/admin/member/{id}", name="member")
     */
    public function adminMemberAction(Request $request, $id)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;


        $doctrine = $this->getDoctrine();
        $userRep = $doctrine->getRepository(User::class);
        $groupeRep = $this->getDoctrine()->getRepository(Groupe::class);
        $apiRep = $this->getDoctrine()->getRepository(CharApi::class);


        $user = $userRep->find($id);
        $groups = $groupeRep->findAll();


        $apis = $apiRep->findByUser($user);

        foreach($apis as $api){
            CCPUtil::isApiValid($api, $doctrine->getManager());
            $api->isValid = true;

            $authentication = new EsiAuthentication([
                'client_id'     => CCPConfig::$clientIDAPI,
                'secret'        => CCPConfig::$secretKEYAPI,
                'refresh_token' => $api->getRefreshToken()
            ]);

            $esi = new Eseye($authentication);
            $portraits = $esi->invoke('get', '/characters/{character_id}/portrait/', [
                'character_id' => $api->getCharId()
            ]);

            $api->portrait = $portraits->px64x64;
        }


        $groupForm = $this->createFormBuilder($user)
            ->add('groupes', EntityType::class, array(
                'class' => 'AppBundle:Groupe',
                'expanded'  => true,
                'choice_label' => 'name',
                'multiple' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Changer groupe'))
            ->getForm();


        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            $user->setGroupe( $groupForm->getData()->getGroupe());

            $doctrine->getManager()->persist($user);
            $doctrine->getManager()->flush();
        }



        $parameters['member'] = $user;
        $parameters['apis'] = $apis;
        $parameters['group_form']  = $groupForm->createView();

        return $this->render('admin/member.html.twig', $parameters);


    }

    /**
     * @Route("/admin/emails/{id}", name="emails")
     */
    public function adminMemberEmailsAction(Request $request, $id)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;


        $api = new MailApi();

        $api->getCharactersCharacterIdMail($user->getCharId(), CCPConfig::$datasource);


    }

    /**
     * @Route("/admin/members", name="members")
     */
    public function adminMemberListAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Admin']));
        if(!is_array($parameters)) return $parameters;


        $corpAPI = new CorporationApi();

        $rep = $this->getDoctrine()->getRepository(User::class);



        $users = null;
        $users = $rep->findAll();

        foreach ($users as $user){

            $corp = $corpAPI->getCorporationsCorporationId($user->getCorpId(), CCPConfig::$datasource);

            $user->corp = $corp;
        }


        $parameters['members'] = $users;
        return $this->render('admin/members.html.twig', $parameters);

    }





}