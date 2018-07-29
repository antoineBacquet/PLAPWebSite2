<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 30/01/2018
 * Time: 21:50
 */

namespace AppBundle\CCP;


use AppBundle\Entity\CharApi;
use Seat\Eseye\Configuration;
use Seat\Eseye\Containers\EsiAuthentication;
use Seat\Eseye\Eseye;
use Seat\Eseye\Exceptions\EsiScopeAccessDeniedException;
use Seat\Eseye\Exceptions\InvalidAuthencationException;
use Seat\Eseye\Exceptions\InvalidConfigurationException;
use Seat\Eseye\Exceptions\RequestFailedException;
use Twig\Cache\NullCache;

class EsiUtil
{

    /**
     * @param string $refreshToken
     * @return EsiAuthentication
     */
    public static function getDefaultAuthentication(string $refreshToken){

        $option = [
            'client_id'     => CCPConfig::$clientIDAPI,
            'secret'        => CCPConfig::$secretKEYAPI
        ];


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
            'secret'        => CCPConfig::$secretKEY
        ];


        $option['refresh_token'] = $refreshToken;

        $authentication = new EsiAuthentication($option);

        return $authentication;

    }

    /**
     * @param Eseye $esi
     * @param string $method
     * @param string $route
     * @param array $params
     * @param array|null $queryParams
     * @param array $body
     * @return \Seat\Eseye\Containers\EsiResponse
     * @throws EsiException
     */
    public static function callESI(Eseye $esi, string $method,  string $route, array $params = array(), array $queryParams = array(), array $body = array()){



       $esi->setQueryString($queryParams);
       $esi->setBody($body);

        try {
            $response = $esi->invoke($method, $route, $params);
        } catch (EsiScopeAccessDeniedException $e) {
            $detail =   'Error code : '. $e->getCode() . PHP_EOL .
                'Error message : ' . $e->getMessage() . PHP_EOL;

            throw new EsiException($detail,"Scope non autorisé", 1);
        }
        catch (InvalidAuthencationException $e) {
            $detail =   'Error code : '. $e->getCode() . PHP_EOL .
                'Error message : ' . $e->getMessage() . PHP_EOL;

            throw new EsiException($detail,"Auhentification invalid", 2);
        }
        catch (InvalidConfigurationException $e) {
            $detail =   'Error code : '. $e->getCode() . PHP_EOL .
                'Error message : ' .  $e->getMessage() . PHP_EOL;

            throw new EsiException($detail,"Mauvaise configuration", 3);
        }
        catch (RequestFailedException $e) {
            $detail =   'Error code : '. $e->getCode() . PHP_EOL .
                'Error message : ' . $e->getMessage() . PHP_EOL.
                'Reponse ESI error code: ' . $e->getEsiResponse()->getErrorCode() . PHP_EOL.
                'Reponse ESI error message : ' . $e->getEsiResponse()->error() . PHP_EOL;

            throw new EsiException($detail, "La requéte a echoué", 4);
        }

        return $response;

    }


}