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
use AppBundle\Entity\Role;
use AppBundle\Entity\Item;
use AppBundle\Entity\Notification;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Illuminate\Contracts\Routing\Registrar;
use Monolog\Registry;
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



    public static $roleMapping = array('Invité' => 'ROLE_GUEST', 'Membre' => 'ROLE_MEMBER', 'Admin' => 'ROLE_ADMIN');

    /**
     * @var User
     */
    private static $user = null;

    public static function userExist(int $charId, ManagerRegistry $doctrine){

        $apiRep = $doctrine->getRepository(CharApi::class);

        $repository = $doctrine->getRepository(User::class);

        $user = $repository->findOneBy(array('charId' => $charId));

        if (!$user){
            $api = $apiRep->findOneByCharId($charId);
            if(!$api) return false;
            return true;
        }

        return true;

    }

    /**
     **
     * @param ManagerRegistry $doctrine
     * @param $charId int
     * @return User
     */
    public static function getUser(ManagerRegistry $doctrine = null, int $charId = null){
        if(UserUtil::$user !== null)return UserUtil::$user;

        if($doctrine !== null and $charId !== null){

            $userRep = $doctrine->getRepository(User::class);
            $apiRep = $doctrine->getRepository(CharApi::class);

            UserUtil::$user = $userRep->findOneByCharId($charId);
            if(UserUtil::$user === null)
                UserUtil::$user = $apiRep->findOneByCharId($charId)->getUser();
        }

        return UserUtil::$user;
    }


    /**
     * @param ManagerRegistry $doctrine
     * @param $charId
     * @throws EsiException
     */
    public static function addUser(ManagerRegistry $doctrine, $charId)
    {

        $esi = new Eseye();

        //character information-----------
        $charInfo = EsiUtil::callESI($esi, 'get' ,'/characters/{character_id}/', array('character_id' => $charId) );

        $roles = array();

        array_push($roles, 'ROLE_GUEST'); //Adding "invité" role

        if ($charInfo->corporation_id == Util::$corpId){
            array_push($roles, 'ROLE_MEMBER'); //If he is a membre of our corporation we add the corporation role
        }

        $user = new User();

        $user->setCharId($charId);
        $user->setCorpId($charInfo->corporation_id);
        $user->setRoles($roles);
        $user->setName($charInfo->name);

        $em = $doctrine->getManager();

        $em->persist($user);
        $em->flush();

        UserUtil::createDefaultNotification($user, $doctrine->getManager());
    }



    public static function hasRole(User $user, $role){
        $userRoles = $user->getRoles();

        foreach ($userRoles as $userRole){
            if($role === $userRole) return true;
        }
        return false;
    }

    public static function createDefaultNotification(User $user, ObjectManager $em){
        $notification = new Notification();
        $notification->setUser($user);
        $user->setNotification($notification);
        $em->persist($user);
        $em->flush();
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
        //die(dump($currentShip));
        $parameters['current_ship'] = array();
        $shipType = $itemRep->find($currentShip->ship_type_id);
        if($shipType == null)
            $parameters['current_ship']['type'] = 'Type de vaisseau inconnue';
        else
        $parameters['current_ship']['type'] = $shipType->getName();

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
            //TODO new esi management
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
