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

                $userGroups = $user->getGroupes();

                $hasGroup = false;
                foreach ($userGroups as $g){
                    if(in_array ($g ->getId(), $groups)){
                        $hasGroup = true;

                    }
                }
                if(!$hasGroup)
                    return $c->redirect('/');

            }
        }



        return $parameters;

    }





}