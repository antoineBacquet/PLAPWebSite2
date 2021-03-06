<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 03:10
 */

namespace AppBundle\CCP;


use AppBundle\Entity\CharApi;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CCPUtil
{

    public static function isApiValid(CharApi $api, ObjectManager $manager) {

        $tokenData = new TokenData($api->getToken(), $api->getRefreshToken());

        if(CCPUtil::isTokenValid($tokenData)){
            $api->isValid = true;
            return true;
        }
        else{
            $tokenData = CCPUtil::updateToken($tokenData);
            if( $tokenData == false){
                $api->isValid = false;
                return false;
            }
            else{
                $api->isValid = true;

                $api->setToken($tokenData->token);
                $api->setRefreshToken($tokenData->refreshToken);
		        $expireOn = new \DateTime();
                $expireOn->add(new \DateInterval('PT1000S'));
                $api->setExpireOn($expireOn);
                $manager->flush();

                return true;

            }
        }
    }


    public static function isTokenValid(TokenData $tokenData) {
        $userAgent = 'PLAP';


        $ch = curl_init();
        // Get the Character details from SSO
        $header = 'Authorization: Bearer ' . $tokenData->token;
        curl_setopt($ch, CURLOPT_URL, CCPConfig::$verifyURL);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($result);


        return isset($response->CharacterID); //si on a le charactere id alors le token est encore valid, sinon il n'est plus valid

    }



    public static function updateToken(TokenData $tokenData){

        $userAgent = 'PLAP';



        $header = 'Authorization: Basic ' . base64_encode(CCPConfig::$clientIDAPI . ':' . CCPConfig::$secretKEYAPI);
        $fields_string = '';
        $fields = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $tokenData->refreshToken,
        );
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, CCPConfig::$tokenURL);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        if ($result === false) {
            //TODO erreur management
            return false;
        }

        curl_close($ch);
        $response = json_decode($result, true);
        if (isset($response['error'])) {
           //TODO better error management
            return false;
        }


        $access_token = $response['access_token'];
        $refresh_token = $response['refresh_token'];

        $tokenData->token = $access_token;
        $tokenData->refreshToken = $refresh_token;

        return $tokenData;
    }

}
