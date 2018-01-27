<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/admin/group')) {
            // groupRemove
            if (0 === strpos($pathinfo, '/admin/group/remove') && preg_match('#^/admin/group/remove/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'groupRemove')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminGroupRemoveAction',));
            }

            // group
            if ('/admin/group' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminGroupAction',  '_route' => 'group',);
            }

        }

        // emails
        if (0 === strpos($pathinfo, '/admin/emails') && preg_match('#^/admin/emails/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'emails')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminMemberEmailsAction',));
        }

        if (0 === strpos($pathinfo, '/member')) {
            // member
            if (preg_match('#^/member/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'member')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminMemberAction',));
            }

            // members
            if ('/members' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminMemberListAction',  '_route' => 'members',);
            }

        }

        elseif (0 === strpos($pathinfo, '/c')) {
            // searchitemajax
            if ('/ccpdata/item/search' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::ccpdataSearchItemAction',  '_route' => 'searchitemajax',);
            }

            // ccpCallBack
            if ('/ccpcallback' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\MainController::ccpCallBackAction',  '_route' => 'ccpCallBack',);
            }

            if (0 === strpos($pathinfo, '/command')) {
                // commandadd
                if ('/command/add' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\CommandController::commandAddAction',  '_route' => 'commandadd',);
                }

                // commandaccept
                if (0 === strpos($pathinfo, '/command/accept') && preg_match('#^/command/accept/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commandaccept')), array (  '_controller' => 'AppBundle\\Controller\\CommandController::commandAcceptAction',));
                }

                if (0 === strpos($pathinfo, '/commands')) {
                    // commandlist
                    if ('/commands' === $pathinfo) {
                        return array (  '_controller' => 'AppBundle\\Controller\\CommandController::commandListAction',  '_route' => 'commandlist',);
                    }

                    // usercommandlist
                    if (0 === strpos($pathinfo, '/commands/user') && preg_match('#^/commands/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'usercommandlist')), array (  '_controller' => 'AppBundle\\Controller\\CommandController::userCommandListAction',));
                    }

                    // commandinfo
                    if (preg_match('#^/commands/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'commandinfo')), array (  '_controller' => 'AppBundle\\Controller\\CommandController::commandAction',));
                    }

                    // removecommand
                    if (0 === strpos($pathinfo, '/commands/remove') && preg_match('#^/commands/remove/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'removecommand')), array (  '_controller' => 'AppBundle\\Controller\\CommandController::removeMyCommandAction',));
                    }

                }

                // commandrefuse
                if (0 === strpos($pathinfo, '/command/refuse') && preg_match('#^/command/refuse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commandrefuse')), array (  '_controller' => 'AppBundle\\Controller\\CommandController::commandRefuseAction',));
                }

            }

        }

        elseif (0 === strpos($pathinfo, '/service/discord')) {
            // testdiscord
            if ('/service/discord/test' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::discordTestAction',  '_route' => 'testdiscord',);
            }

            // discordservice
            if ('/service/discord' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::serviceAction',  '_route' => 'discordservice',);
            }

            // updatemyroles
            if ('/service/discord/updateroles' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::updateMyRolesAction',  '_route' => 'updatemyroles',);
            }

        }

        // discordjoin
        if ('/discord/join' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($rawPathinfo.'/', 'discordjoin');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DiscordController::discordJoinAction',  '_route' => 'discordjoin',);
        }

        // discordredirect
        if ('/discord/redirect' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($rawPathinfo.'/', 'discordredirect');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DiscordController::discordRedirectAction',  '_route' => 'discordredirect',);
        }

        // emailsmenu
        if ('/emails' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\EmailController::emailsMenuAction',  '_route' => 'emailsmenu',);
        }

        if (0 === strpos($pathinfo, '/profile')) {
            if (0 === strpos($pathinfo, '/profile/emails')) {
                // myemails1
                if (preg_match('#^/profile/emails/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'myemails1')), array (  '_controller' => 'AppBundle\\Controller\\EmailController::myEmailsNoLabelAction',));
                }

                // myemails
                if (preg_match('#^/profile/emails/(?P<id>[^/]++)/label/(?P<label_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'myemails')), array (  '_controller' => 'AppBundle\\Controller\\EmailController::myEmailsAction',));
                }

            }

            // email
            if (0 === strpos($pathinfo, '/profile/email') && preg_match('#^/profile/email/(?P<id_api>[^/]++)/(?P<id_email>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'email')), array (  '_controller' => 'AppBundle\\Controller\\EmailController::emailAction',));
            }

            // profile
            if ('/profile' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::profileAction',  '_route' => 'profile',);
            }

            if (0 === strpos($pathinfo, '/profile/api')) {
                // myapis
                if ('/profile/apis' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\UserController::myApisAction',  '_route' => 'myapis',);
                }

                // myapi
                if (preg_match('#^/profile/api/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'myapi')), array (  '_controller' => 'AppBundle\\Controller\\UserController::myApiAction',));
                }

            }

            // addapi
            if ('/profile/addapi' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::addApiAction',  '_route' => 'addapi',);
            }

            // ccpcallbackapi
            if ('/profile/ccpcallback' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::ccpCallBackApiAction',  '_route' => 'ccpcallbackapi',);
            }

            // mycommands
            if ('/profile/commands' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::myCommandAction',  '_route' => 'mycommands',);
            }

            // removeapi
            if (0 === strpos($pathinfo, '/profile/removeapi') && preg_match('#^/profile/removeapi/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'removeapi')), array (  '_controller' => 'AppBundle\\Controller\\UserController::removeApiAction',));
            }

            // myorder
            if ('/profile/order' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::myOrderAction',  '_route' => 'myorder',);
            }

        }

        // homepage
        if ('' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($rawPathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\MainController::indexAction',  '_route' => 'homepage',);
        }

        // login
        if ('/login' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\MainController::loginAction',  '_route' => 'login',);
        }

        // logout
        if ('/logout' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\MainController::logoutAction',  '_route' => 'logout',);
        }

        // test
        if ('/test' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\MainController::testAction',  '_route' => 'test',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
