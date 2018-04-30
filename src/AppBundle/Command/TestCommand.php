<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/04/2018
 * Time: 01:20
 */

namespace AppBundle\Command;

use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\CharApi;
use AppBundle\Util\Util;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
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
            ->setDescription('test the command.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to test stuff...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        //$this->getApplication()->
        $apiRep = $doctrine->getManager()->getRepository(CharApi::class);

        $apis = $apiRep->findAll();

        /**
         * @var CharApi $api
         */
        foreach ($apis as $api){

            $auth = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));

            try {
                $mails = EsiUtil::callESI($auth,'get','/characters/{character_id}/mail/', ['character_id' => $api->getCharId()]);

                //$output->writeln(var_dump($mailsHeaderEsi) );

                if(count($mails)>0){

                    if(isset($mails[0])){
                        if($mails[0]->mail_id>$api->getLastEmail()){
                            $api->setLastEmail($mails[0]->mail_id);
                            $doctrine->getManager()->persist($api);
                            $doctrine->getManager()->flush();
                            if($api->getUser()->getDiscordId() !== null){
                                $webhook = new Client(DiscordConfig::$webhook_url);
                                //$embed = new Embed();
                                //$embed->description('Demande de test du discord');
                                //$sender = EsiUtil::callESI($auth,'get','/characters/{character_id}/mail/', ['character_id' => $api->getCharId()]);

                                try{
                                    $webhook->username('Mail Bot')->message('!newMail_<@' . $api->getUser()->getDiscordId() .'>_' .  $api->getCharName(). '_someone')->send();
                                    $output->writeln('sending');
                                }
                                catch (\Exception $e){
                                    //TODO better error
                                    $output->writeln('ESI Error ' . $e->getMessage() );
                                }

                            }
                        }
                    }


                }


            }
            catch (EsiException $e){
                //TODO
                $output->writeln('ESI Error ' . $e->getDetail() );
            }

        }
    }
}