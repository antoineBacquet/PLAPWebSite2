<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/12/2018
 * Time: 02:00
 */

namespace AppBundle\Command;


use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateApiSkillCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:api:skill')

            // the short description shown while running "php bin/console list"
            ->setDescription('Test.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $apiRep = $em->getRepository(CharApi::class);

        $apis = $apiRep->findAll();

        $output->writeln('Starting updating everyone skills');

        /** @var $api CharApi */
        foreach ($apis as $api) {
            $output->writeln('Updating ' . $api->getCharName() . '\'s skills...');

            $auth = EsiUtil::getDefaultAuthentication($api->getRefreshToken());

            $esi = new Eseye($auth);

            try{

                $skills = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/skills/', array('character_id' => $api->getCharId()));

                //dump($skills);
                $skillsArray = array('skills' => array(), 'total_sp' => $skills['total_sp'], 'unallocated_sp' => isset($skills['unallocated_sp'])?$skills['unallocated_sp']:0);
                foreach ($skills['skills'] as $skill){
                    $skillArray = array('id' => $skill->skill_id ,
                        'level' => $skill->trained_skill_level,
                        'skillpoints' => $skill->skillpoints_in_skill);

                    $skillsArray['skills'][$skill->skill_id] = $skillArray;
                }

                $api->setSkills($skillsArray);

                $em->persist($api);


                $output->writeln('Success');
            }
            catch (EsiException $e){
                $output->writeln('Error : ' . $e->getDetail());
            }
            catch (\Exception $e){
                $output->writeln('Error : ' . $e->getMessage());
            }

        }

        $em->flush();


        $output->writeln('Update completed.');

    }
}