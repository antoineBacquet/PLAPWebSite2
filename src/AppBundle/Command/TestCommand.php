<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 15/05/2018
 * Time: 18:50
 */

namespace AppBundle\Command;


use AppBundle\Discord\DiscordConfig;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:test')

            // the short description shown while running "php bin/console list"
            ->setDescription('Test.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $webhook = new Client(DiscordConfig::$webhook_url);
        $embed = new Embed();
        $embed->title('Test des trucs');
        $embed->field('Test field','Ceci est un field');
        $embed->description('TEST');
        $webhook->username('Bot')->message('!blbl <@211493008108027905>')->embed($embed)->send();
    }
}