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
use AppBundle\Entity\Route;
use AppBundle\Entity\User;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Symfony\Component\HttpFoundation\Request;

class DiscordUtil
{


    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
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

    public static function sendNewLogi(Route $route,User $user, $reward, $size, $colat){


        $webhook = new Client(DiscordConfig::$webhook_logi);
        $webhook->username('Logi bot');

        $webhook->message('<@&' . DiscordConfig::$role_logi . '>'); //TODO global<@&475727462064586756>

        $embed = new Embed();
        $embed->title('Noueaux contrat de ' . $user->getName() . ': ' . $route->getStart()->getName() . ' -> ' . $route->getEnd()->getName() . '.'); //TODO
        $embed->description('Reward: ' . number_format ($reward,0, '.', ' ')
            . ' isk, taille: ' . number_format ($size ,0, '.', ' ')
            . ' m3, colateral: ' . number_format ($colat,0, '.', ' ') . ' isk.');

        $webhook->embed($embed);

        $webhook->send();

    }

}