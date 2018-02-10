<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 29/10/2017
 * Time: 13:54
 */

namespace AppBundle\Util;


use AppBundle\Entity\Item;
use AppBundle\Repository\ItemRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Adapter\DoctrineAdapter;
use Symfony\Component\HttpFoundation\Request;

class ControllerUtil extends Controller
{


    public static function beforeRequest(Controller $c, Request $r, Array $groups = null){




        $parameters = Core::getDefaultParameter($c->getDoctrine(), $r);
        $parameters['base_dir'] = realpath($c->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;



        if($groups!= null){

            $user = UserUtil::getUser($c->getDoctrine(), $r);
            if( $user == null)
                return $c->redirect('/');
            else{


                if(!UserUtil::hasGroups($user, $groups))
                    return $c->redirect('/');

            }
        }



        return $parameters;

    }

    public static function before(Controller $c, Request $r, Array $groups = null){

        $parameters = Core::getDefaultParameter($c->getDoctrine(), $r);
        $parameters['base_dir'] = realpath($c->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        if($groups!= null) {

            $user = UserUtil::getUser($c->getDoctrine(), $r);
            if ($user == null) {
                $parameters['redirect'] = true;
                $parameters['redirect_path'] = 'error/forbidden.html.twig';
                $parameters['message'] = 'Tu dois être connecté pour voir ca';
            }
            else{
                if(!UserUtil::hasGroups($user, $groups)){
                    $parameters['redirect'] = true;
                    $parameters['redirect_path'] = 'error/forbidden.html.twig';
                    $parameters['message'] = 'Tu n\'as pas le doit de voir ca';
                }

            }
        }

        return $parameters;

    }





}