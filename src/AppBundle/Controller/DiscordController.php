<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 31/10/2017
 * Time: 23:01
 */

namespace AppBundle\Controller;


use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\User;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\Core;
use AppBundle\Util\DiscordUtil;
use AppBundle\Util\GroupUtil;
use AppBundle\Util\UserUtil;
use Discord\OAuth\Parts\Invite;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class DiscordController  extends Controller
{


    /**
     * Discord service
     *
     * @Route("/service/discord", name="discordservice")
     */
    public function serviceAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        return $this->render('profile/service.html.twig', $parameters);

    }


    /**
     * Join the discord
     *
     * @Route("/discord/join/", name="discordjoin")
     */
    public function discordJoinAction(Request $request)
    {

        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;

        $url = DiscordConfig::$loginURI;

        $url = $url . "&client_id=" . DiscordConfig::$cliendId;
        $url = $url . "&scope=identify+guilds.join";
        $url = $url . "&state=15773059ghq9183habn";
        $url = $url . "&redirect_uri=" . DiscordConfig::$redirectURI;
        return $this->redirect($url);

    }

    /**
     * discord call back
     *
     * @Route("/discord/redirect/", name="discordredirect")
     */
    public function discordRedirectAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        $user = UserUtil::getUser($this->getDoctrine(), $request);



        $provider = new \Discord\OAuth\Discord([
            'clientId'     => DiscordConfig::$cliendId,
            'clientSecret' => DiscordConfig::$cliendSecret,
            'redirectUri'  => DiscordConfig::$redirectURI,
        ]);

        if (! isset($_GET['code'])) {
            if(!$user) return $this->redirect($this->generateUrl('homepage'));
        } else {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'],
            ]);

            // Get the user object.


            /**
             * @var  $discordUser
             */
            $discordUser = $provider->getResourceOwner($token);

            // Get the guilds and connections.
            $guilds = $discordUser->guilds;
            $connections = $discordUser->connections;


            /**
             * @var Invite $invite
             */
            // Accept an invite
            $invite = $discordUser->acceptInvite('https://discord.gg/aBM2rwn'); //TODO Global variable

            $user->setDiscordId($discordUser->getId());
            $em = $this->getDoctrine()->getManager();
            $em->flush();



            //TODO Static function
            $webhook = new Client(DiscordConfig::$webhook_url);
            $embed = new Embed();
            $embed->description('Demande de test du discord');
            $webhook->username('Bot')->message('!test <@' . $user->getDiscordId() .'>')->embed($embed)->send();

            DiscordUtil::updateRoles($user);

        }

        //-----------------------------------------------------------------------------------------


        return $this->redirect($this->generateUrl('discordservice'));

    }

    /**
     * Request to update roles on discord
     *
     * @Route("/service/discord/updateroles", name="updatemyroles")
     */
    public function updateMyRolesAction(Request $request)
    {
        $parameters = ControllerUtil::beforeRequest($this, $request, array(GroupUtil::$GROUP_LISTE['Membre']));
        if(!is_array($parameters)) return $parameters;


        DiscordUtil::updateRoles(UserUtil::getUser($this->getDoctrine(),$request)); //TODO error management

        return $this->redirect($this->generateUrl('discordservice'));

    }





}
