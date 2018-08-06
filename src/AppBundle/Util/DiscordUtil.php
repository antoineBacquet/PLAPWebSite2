<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 23/11/2017
 * Time: 23:52
 */

namespace AppBundle\Util;


use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\Command;
use AppBundle\Entity\CommandItem;
use AppBundle\Entity\User;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Symfony\Component\HttpFoundation\Request;

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

    public static function sendNewCommand(Command $c, string $url){


        $webhook = new Client(DiscordConfig::$webhook_command);
        $webhook->username('Command bot');

        $webhook->message('<@&475727462064586756>'); //TODO global

        $embed = new Embed();
        $embed->title('Nouvelle commande de ' . $c->getIssuer()->getName() . '. Prix estimé : ' . number_format($c->getEstimatedPrice()) . ' isk'); //TODO
        $embed->description($url . ' -------- ' . $c->getEvepraisal());
        $field = "";

        /**
         * @var CommandItem $item
         */
        //dump($c->getItems());
        foreach ($c->getItems() as $item){
            $field = $field . '``` ' . $item->getItem()->getName() . ' x' . $item->getQuantity() . ' ``` ';
        }
        //die($field);

        $embed->field('Items : ', $field);

        $webhook->embed($embed);

        $webhook->send();



    }

}