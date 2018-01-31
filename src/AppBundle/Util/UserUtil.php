<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 16:30
 */

namespace AppBundle\Util;


use AppBundle\CCP\CCPConfig;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Groupe;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use nullx27\ESI\Api\CharacterApi;
use function Sodium\add;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\CCP\CCPUtil;

class UserUtil
{


    /**
     * @var User
     */
    private static $user = null;

    public static function userExist(SessionInterface $session, Registry $doctrine){

        $apiRep = $doctrine->getRepository(CharApi::class);

        $repository = $doctrine->getRepository(User::class);

        $user = $repository->findOneBy(array('charId' => $session->get('char_id')));

        if (!$user){
            $api = $apiRep->findOneByCharId($session->get('char_id'));
            if(!$api) return false;
            $session->set('char_id', $api->getUser()->getCharId() );
            return true;
        }

        return true;


    }

    /**
     ** @return User
     */
    public static function getUser(Registry $doctrine, Request $request){
        if(UserUtil::$user!=null)return UserUtil::$user;

        $rep = $doctrine->getRepository(User::class);

        UserUtil::$user = $rep->findOneByCharId($request->getSession()->get('char_id'));

        if(UserUtil::$user == null) return null;

        foreach (  UserUtil::$user->getGroupes() as $group){
            if($group->getId() == GroupUtil::$GROUP_LISTE['Membre']){
                UserUtil::$user->isMember = true;
            }

            if($group->getId() == GroupUtil::$GROUP_LISTE['Admin']){
                UserUtil::$user->isAdmin = true;
            }

            if($group->getId() == GroupUtil::$GROUP_LISTE['Responsable de production']){
                UserUtil::$user->isProdResp = true;
            }
        }
        return UserUtil::$user;

    }


    public static function addUser(SessionInterface $session, Registry $doctrine){


         $api = new CharacterApi();


        $charInfo = $api->getCharactersCharacterId($session->get('char_id'), CCPConfig::$datasource);

        $rep = $doctrine->getRepository(Groupe::class);

        $groups = array();

        array_push($groups, $rep->find(1));

        if ($charInfo->getCorporationId() == Util::$corpId){
            array_push($groups, $rep->find(2));
        }

        $user = new User();

        $user->setCharId($session->get('char_id'));
        $user->setCorpId($charInfo->getCorporationId());
        foreach ($groups as $group){
            $user->addGroupe($group);
        }
        $user->setName($charInfo->getName());
        $user->setDiscordRandomString(Util::generateRandomString(128));
        $em = $doctrine->getManager();

        $em->persist($user);
        $em->flush();
    }


    public static function isConnected(Request $request){
        //si il n'y a pas de session l'utilisateur ne sais jamais connecté sur le site
        $session = $request->getSession();
        if (!$session) {
            return false;
        }



        //Si il n'y a pas de token et de refresh token, l'utilisateur est deconnecter
        if($session->has('char_id') and $session->has('refresh_token')){ //TODO test on the refresh token
            return true;
        }
        return false;
    }


    public static function hasGroups(User $user, array $groups){
        $userGroups = $user->getGroupes();

        $hasGroup = false;
        foreach ($userGroups as $g){
            if(in_array ($g ->getId(), $groups)){
                $hasGroup = true;

            }
        }

        return $hasGroup;
    }

}
