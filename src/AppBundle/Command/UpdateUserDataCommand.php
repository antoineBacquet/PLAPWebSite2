<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 30/08/2018
 * Time: 18:03
 */

namespace AppBundle\Command;


use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\User;
use AppBundle\Util\Util;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateUserDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:user')

            // the short description shown while running "php bin/console list"
            ->setDescription('Update user data.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Update user data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $userRep = $em->getRepository(User::class);

        $esi = new Eseye();

        $users = $userRep->findAll();

        /**
         * @var User $user
         */
        foreach ($users as $user){
            $isPLAP = false;

            $userData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $user->getCharId()));

            if($userData->corporation_id == Util::$corpId) $isPLAP = true;

            if($userData->corporation_id != $user->getCorpId()) {
                $user->setCorpId($userData->corporation_id);
                $em->persist($user);
                $output->writeln(date("Y-m-d h:i:s") . ' : User ' . $user->getName() . ' has changed corp.');
            }

            /**
             * @var CharApi $api
             */
            foreach ($user->getApis() as $api){
                $apiData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/', array('character_id' => $api->getCharId()));

                if($apiData->corporation_id == Util::$corpId) $isPLAP = true;

            }

            if(!$isPLAP)
                foreach ($user->getRoles() as $role)
                    if($role == "ROLE_MEMBER"){
                        $user->removeRole('ROLE_MEMBER');
                        $em->persist($user);
                        $output->writeln(date("Y-m-d h:i:s") . ' : User ' . $user->getName() . ' is not a PLAP anymore :( .');
                    }

            $em->flush();
        }
    }
}