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
use AppBundle\Entity\Job;
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
        $jobRep = $doctrine->getManager()->getRepository(Job::class);




        $apis = $apiRep->findAll();

        /**
         * @var CharApi $api
         */
        foreach ($apis as $api) {

            $auth = new Eseye(EsiUtil::getDefaultAuthentication($api->getRefreshToken()));
            $now = new \DateTime("now", new \DateTimeZone('UTC'));

            try {



                $oldJobs = $jobRep->findByOwner($api);

                foreach ($oldJobs as $oldJob)
                    $doctrine->getManager()->remove($oldJob);
                $doctrine->getManager()->flush();

                $jobs = EsiUtil::callESI($auth, 'get', '/characters/{character_id}/industry/jobs/', ['character_id' => $api->getCharId()]);


                foreach ($jobs as $job){

                    $correspondingOldJob = null;
                    foreach ($oldJobs as $oldJob)
                        if($oldJob->getId() == $job->job_id)$correspondingOldJob = $oldJob;


                    //TODO paused status
                    $status = "other";
                    if($job->status === "active"){
                        //test if the jobs is finished
                        if(new \DateTime($job->end_date) < $now){ //job finished
                            //test if we had the job saved in our database
                            if($correspondingOldJob !== null){ //job in database
                                //test we the jobs wasn't already finished
                                if($correspondingOldJob->getState() !== "finished"){ //job wasn't already finished

                                    //job wasn't already finished and is now finished -> we send a notification
                                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----1send notification for job :  ' . $job->job_id );
                                    $status = "finished";
                                }
                                else //job was already finished
                                    $status = "finished";
                            }
                            else{ //job not in database
                                //finished and not in database -> we send a notification
                                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----2send notification for job :  ' . $job->job_id );
                                $status = "finished";
                            }
                        }
                        else{ //job not finished
                            $status = "active";
                        }
                    }

                    $jobToAdd = new Job();
                    $jobToAdd->setId($job->job_id)
                        ->setOwner($api)
                        ->setActivityId($job->activity_id)
                        ->setBlueprintId($job->blueprint_id)
                        ->setBlueprintTypeId($job->blueprint_type_id)
                        ->setStartDate(new \DateTime($job->start_date))
                        ->setEndDate(new \DateTime($job->end_date))
                        ->setDuration($job->duration)
                        ->setStationId($job->station_id)
                        ->setState($status);
                    $doctrine->getManager()->persist($jobToAdd);
                    /*$output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----activity id :  ' . $job->activity_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----blueprint_id :  ' . $job->blueprint_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----blueprint_type_id :  ' . $job->blueprint_type_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----job_id :  ' . $job->job_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----runs :  ' . $job->runs );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----station_id :  ' . $job->station_id );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----status :  ' . $job->status );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----start_date :  ' . $job->start_date );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----end_date :  ' . $job->end_date );
                    $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----duration :  ' . $job->duration );*/
                }
                $doctrine->getManager()->flush();

            }
            catch (EsiException $e){
                $output->writeln('[ ' . date('Y-m-d H:i:s') . ' ] ' . '----ESI Error for ' . $api->getCharName() . ' : ' . $e->getDetail() );
            }

        }

    }

}