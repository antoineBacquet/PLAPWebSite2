<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 09/09/2018
 * Time: 11:54
 */


namespace AppBundle\Command;


use AppBundle\CCP\EsiUtil;
use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\System;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SystemUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:system')

            // the short description shown while running "php bin/console list"
            ->setDescription('Update systems information.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Update systems information.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        ini_set('memory_limit', '512M');

        $configuration = Configuration::getInstance();
        $configuration->__set('cache', NullCache::class);

        $doctrine = $this->getContainer()->get('doctrine');
        $systemRep = $doctrine->getRepository(System::class);

        $esi = new Eseye();

        //------------------------ Category
        $systemsId =  EsiUtil::callESI($esi, 'get', '/universe/systems/');

        foreach ($systemsId as $systemId){
            $systemData = EsiUtil::callESI($esi, 'get', '/universe/systems/{system_id}/', array('system_id' => $systemId));

            $system = $systemRep->find($systemId);
            if($system == null){
                $system = new System();
                $system->setId($systemId);
            }
            $system->setName($systemData->name);

            $output->writeln(date("Y-m-d h:i:s") . ' : update du system ' . $systemId . ' -> ' . $system->getName());

            $doctrine->getManager()->persist($system);
        }
        $doctrine->getManager()->flush();
    }
}