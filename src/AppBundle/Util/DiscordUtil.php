<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 23/11/2017
 * Time: 23:52
 */

namespace AppBundle\Util;


use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\User;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;

class DiscordUtil
{

    public static function updateRoles(User $user){

        if($user->getDiscordId() == null)return false;

        $webhook = new Client(DiscordConfig::$webhook_url);
        $embed = new Embed();

        $embed->description('Demande de mise a jour des roles');

        $webhook->username('Bot')->message('!ur <@' . $user->getDiscordId() .'>')->embed($embed)->send();

        return true;
    }

}