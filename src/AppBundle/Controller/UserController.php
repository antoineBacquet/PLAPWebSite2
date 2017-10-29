<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 29/10/2017
 * Time: 13:51
 */

namespace AppBundle\Controller;


use AppBundle\Util\UserUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Util\Core;

class UserController extends Controller
{


    /**
     * This route de the profile page of a user
     *
     * @Route("/profile", name="profile")
     */
    public function profileAction(Request $request)
    {

        $parameters = Core::getDefaultParameter($this->getDoctrine(), $request);
        $parameters['base_dir'] = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        if(UserUtil::getUser($this->getDoctrine(), $request) == null)
            return $this->redirect('/');

        $session = $request->getSession();

        if(!$session)
            return $this->redirect('/');

        if ($session->get('token')){
            return $this->render('profile/index.html.twig', $parameters);
        }


        else {
            return $this->redirect('/');
        }
    }
}