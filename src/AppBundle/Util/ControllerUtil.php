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


    public static function before(Controller $c){


        $parameters = array();

        $parameters['base_dir'] = realpath($c->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        if($c->getUser() !== null) $parameters['user'] = $c->getUser();

        return $parameters;

    }





}