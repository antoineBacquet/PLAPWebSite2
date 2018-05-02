<?php


namespace AppBundle\Util;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;


/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 28/07/2017
 * Time: 20:36
 */
class Core
{


    public static function getDefaultParameter(Registry $doctrine, Request $request){


        $parameters = array();

        if(UserUtil::isConnected($request, $doctrine)){

            $user = UserUtil::getUser($doctrine, $request);


            $parameters['user'] = $user;
        }

        return $parameters;


    }







}