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
use AppBundle\Util\UserUtil;
use AppBundle\Util\Util;
use DiscordWebhooks\Client;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class mailWatcherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:mail')

            // the short description shown while running "php bin/console list"
            ->setDescription('Look for new mail and send a discord notification.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Look for new mail and send a discord notification.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . 'Starting new mail notification');

        $doctrine = $this->getContainer()->get('doctrine');
        $apiRep = $doctrine->getManager()->getRepository(CharApi::class);

        $apis = $apiRep->findAll();

        /**
         * @var CharApi $api
         */
        foreach ($apis as $api){

            $auth = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));

            try {
                $mails = EsiUtil::callESI($auth,'get','/characters/{character_id}/mail/', ['character_id' => $api->getCharId()]);

                if(count($mails)>0 && isset($mails[0])){
                    if($mails[0]->mail_id>$api->getLastEmail()){
                        $api->setLastEmail($mails[0]->mail_id);
                        $doctrine->getManager()->persist($api);
                        $doctrine->getManager()->flush();
                        if($api->getUser()->getNotification() === null)UserUtil::createDefaultNotification($api->getUser(), $doctrine->getManager());
                        if($api->getUser()->getDiscordId() !== null && $api->getUser()->getNotification()->getEmailNotification()){
                            $webhook = new Client(DiscordConfig::$webhook_url);
                            $sender = EsiUtil::callESI($auth,'get','/characters/{character_id}/', ['character_id' => $mails[0]->from]);
                            try{
                                $message = '!newMail_<@' . $api->getUser()->getDiscordId() .'>_' .  $api->getCharName(). '_' . $sender->name;
                                $webhook->username('Mail Bot')->message($message)->send();
                                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----Sending new mail notification to ' . $api->getCharName());
                            }
                            catch (\Exception $e){
                                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----Discord Webhook Error for ' . $api->getCharName() . ' : ' . $e->getMessage() );
                            }
                        }
                    }
                    else
                        $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----No new mail for ' . $api->getCharName());
                }
                else
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----No mail for ' . $api->getCharName());

            }
            catch (EsiException $e){
                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----ESI Error for ' . $api->getCharName() . ' : ' . $e->getDetail() );
            }

        }

        $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . 'Ending new mail notification');
    }
}