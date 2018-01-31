<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 30/01/2018
 * Time: 21:50
 */

namespace AppBundle\CCP;


use AppBundle\Entity\CharApi;
use Seat\Eseye\Containers\EsiAuthentication;

class EsiUtil
{

    /**
     * @param string $refreshToken
     * @return EsiAuthentication
     */
    public static function getDefaultAuthentication(string $refreshToken){

        $option = [
            'client_id'     => CCPConfig::$clientIDAPI,
            'secret'        => CCPConfig::$secretKEYAPI];


        $option['refresh_token'] = $refreshToken;


        $authentication = new EsiAuthentication($option);

        return $authentication;

    }

    /**
     * @param string $refreshToken
     * @return EsiAuthentication
     */
    public static function getDefaultUserAuthentication(string $refreshToken){
        $option = [
            'client_id'     => CCPConfig::$clientID,
            'secret'        => CCPConfig::$secretKEY];


        $option['refresh_token'] = $refreshToken;


        $authentication = new EsiAuthentication($option);

        return $authentication;

    }


}