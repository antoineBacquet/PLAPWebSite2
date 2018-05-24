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
use AppBundle\Util\DiscordUtil;
use AppBundle\Util\UserUtil;
use Discord\OAuth\Parts\Invite;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class DiscordController  extends Controller
{


    /**
     * Discord service
     *
     * @Route("/service/discord", name="discordservice")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function serviceAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);


        return $this->render('profile/service.html.twig', $parameters);

    }


    /**
     * Join the discord
     *
     * @Route("/discord/join/", name="discordjoin")
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function discordJoinAction(Request $request)
    {

        $parameters = ControllerUtil::before($this);

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
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function discordRedirectAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);


        $user = $this->getUser();



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


            /**
             * @var Invite $invite
             */
            // Accept an invite
            $discordUser->acceptInvite('https://discord.gg/aBM2rwn'); //TODO Global variable

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
     * @Security("has_role('ROLE_MEMBER')")
     */
    public function updateMyRolesAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);


        DiscordUtil::updateRoles($this->getUser());

        return $this->redirect($this->generateUrl('discordservice'));

    }

    /**
     * Request to update roles on discord
     *
     * @Route("/service/discord/updateroles/{id}", name="updatediscordroles")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateDiscordRolesAction(Request $request, $id)
    {
        $parameters = ControllerUtil::before($this);

        $rep = $this->getDoctrine()->getRepository(User::class);
        $user = $rep->find($id);

        if($user == null){
            throw $this->createNotFoundException('Utilisateur non trouvé dans la base de données.');
        }
        else{
            DiscordUtil::updateRoles($this->getUser()); //TODO error management
        }


        return $this->redirect($this->generateUrl('discordservice'));

    }





}
