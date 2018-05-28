<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 11/05/2018
 * Time: 01:09
 */

namespace AppBundle\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{


    private $router;

    private $twig;

    private $tokenStorage;

    public function __construct(RouterInterface $router, \Twig_Environment $twig, TokenStorageInterface $tokenStorage)
    {
        $this->router = $router;

        $this->twig = $twig;

        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $parameter = array();

        $user = $this->tokenStorage->getToken()->getUser();

        //If the user is connected then he tried to access something he can't
        if($user !== null) {
            $parameter['user'] = $user;
            $parameter['message'] = $accessDeniedException->getMessage();
            $content = $this->twig->render('error/forbidden.html.twig', $parameter);
            return new Response($content);
        }

        //if the user is not connected then he must login
        else{
            return new RedirectResponse($this->router->generate('login'));
        }



    }

}