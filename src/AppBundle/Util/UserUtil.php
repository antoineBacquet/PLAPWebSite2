<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 16:30
 */

namespace AppBundle\Util;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Groupe;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use nullx27\ESI\Api\CharacterApi;
use Seat\Eseye\Eseye;
use Seat\Eseye\Exceptions\EsiScopeAccessDeniedException;
use Seat\Eseye\Exceptions\RequestFailedException;
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

    public static function userExist(SessionInterface $session, ManagerRegistry $doctrine){

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
     **
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return User
     */
    public static function getUser(ManagerRegistry $doctrine, Request $request){
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


    public static function addUser(ManagerRegistry $doctrine, $refreshToken, $charId){

        $authentication = EsiUtil::getDefaultUserAuthentication($refreshToken);
        $esi = new Eseye($authentication);

        //character information-----------
        $charInfo = $esi->invoke('get', '/characters/{character_id}/', [
            'character_id' => $charId,
        ]);

        $rep = $doctrine->getRepository(Groupe::class);

        $groups = array();

        array_push($groups, $rep->find(1));

        if ($charInfo->corporation_id == Util::$corpId){
            array_push($groups, $rep->find(2));
        }

        $user = new User();

        $user->setCharId($charId);
        $user->setCorpId($charInfo->corporation_id);
        foreach ($groups as $group){
            $user->addGroupe($group);
        }
        $user->setName($charInfo->name);

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
            if(in_array ($g->getId(), $groups)){
                $hasGroup = true;
            }
        }

        return $hasGroup;
    }

    /**
     * @param CharApi $api
     * @param ManagerRegistry $manager
     * @return array
     * @throws EsiException
     */
    public static function getApiSummary(CharApi $api, ManagerRegistry $manager){

        $parameters = array();

        //setting the esi api
        $authentication = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($authentication);

        //character information-----------
        /*$charInfo = $esi->invoke('get', '/characters/{character_id}/', [
            'character_id' => $api->getCharId(),
        ]);*/

        $charInfo = EsiUtil::callESI($esi, 'get','/characters/{character_id}/', ['character_id' => $api->getCharId()]);
        //--------------------------------

        $parameters['api'] = $api;


        //portrait------------------------
        $portrait = EsiUtil::callESI($esi, 'get','/characters/{character_id}/portrait/', ['character_id' => $api->getCharId()])->px128x128;
        $parameters['portrait'] = $portrait;
        //--------------------------------


        //corp----------------------------
        $corp = EsiUtil::callESI($esi, 'get','/corporations/{corporation_id}/', ['corporation_id' => $charInfo->corporation_id])->name;
        $parameters['corp'] = $corp;
        //--------------------------------

        //corp history--------------------
        $corpsHistory = EsiUtil::callESI($esi, 'get','/characters/{character_id}/corporationhistory/', [ 'character_id' => $api->getCharId()])->getArrayCopy();

        $lastCorp = current($corpsHistory);

        $now = new \DateTime();
        $startDate = new \DateTime($lastCorp->start_date);

        $joined = $now->diff($startDate)->format("%a");
        $parameters['joined'] = $joined;
        //--------------------------------

        //skill points--------------------
        $skillPoints = EsiUtil::callESI($esi, 'get','/characters/{character_id}/skills/', [ 'character_id' => $api->getCharId()])->total_sp;
        $parameters['skillpoints'] = $skillPoints;
        //--------------------------------

        //wallet--------------------------
        $wallet = EsiUtil::callESI($esi, 'get','/characters/{character_id}/wallet/', [ 'character_id' => $api->getCharId()]);
        $parameters['wallet'] = $wallet->getArrayCopy()['scalar'];
        //--------------------------------

        //current ship--------------------
        $currentShip = EsiUtil::callESI($esi, 'get','/characters/{character_id}/ship/', [ 'character_id' => $api->getCharId()]);

        $itemRep = $manager->getRepository(Item::class);
        $parameters['current_ship'] = array();
        $parameters['current_ship']['type'] = $itemRep->find($currentShip->ship_type_id)->getName();
        $parameters['current_ship']['name'] = $currentShip->ship_name;
        //--------------------------------

        //location------------------------
        $location = EsiUtil::callESI($esi, 'get','/characters/{character_id}/location/', [ 'character_id' => $api->getCharId()]);

        //station
        if(isset($location->station_id)){
            $parameters['location']['type'] = 'station';
            $station = EsiUtil::callESI($esi, 'get','/universe/stations/{station_id}/', [ 'station_id' => $location->station_id]);

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
                $parameters['location']['name'] = "Structure inconnue";
            }
            catch (RequestFailedException $e){
                $parameters['location']['name'] = "Structure inconnue";
            }
        }

        //dans l'espsace
        else{
            $parameters['location']['type'] = 'space';
        }

        //security status-----------------
        $parameters['security_status'] = $charInfo->security_status;

        return $parameters;

        //--------------------------------
    }

}
