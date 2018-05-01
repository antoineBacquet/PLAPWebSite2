<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 01/05/2018
 * Time: 13:30
 */

namespace AppBundle\Command;


use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class jobWatcherCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:job')

            // the short description shown while running "php bin/console list"
            ->setDescription('Look for new job and send a discord notification.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Look for new job and send a discord notification.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $doctrine = $this->getContainer()->get('doctrine');
        $apiRep = $doctrine->getManager()->getRepository(CharApi::class);

        $apis = $apiRep->findAll();

        /**
         * @var CharApi $api
         */
        foreach ($apis as $api) {

            $auth = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));

            try {
                $jobs = EsiUtil::callESI($auth, 'get', '/characters/{character_id}/industry/jobs/', ['character_id' => $api->getCharId()]);

                foreach ($jobs as $job){
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----activity id :  ' . $job->activity_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----blueprint_id :  ' . $job->blueprint_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----blueprint_type_id :  ' . $job->blueprint_type_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----job_id :  ' . $job->job_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----runs :  ' . $job->runs );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----station_id :  ' . $job->station_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----status :  ' . $job->status );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----start_date :  ' . $job->start_date );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----end_date :  ' . $job->end_date );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----duration :  ' . $job->duration );
                }

            }
            catch (EsiException $e){
                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----ESI Error for ' . $api->getCharName() . ' : ' . $e->getDetail() );
            }

        }

    }

}