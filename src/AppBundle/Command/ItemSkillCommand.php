<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 22/07/2018
 * Time: 20:18
 */

namespace AppBundle\Command;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\Item;
use AppBundle\Entity\Skill;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ItemSkillCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:item:skill')

            // the short description shown while running "php bin/console list"
            ->setDescription('Test.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Test.');

        $this->addArgument('startWith', InputArgument::OPTIONAL, 'Stating id', 0);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        ini_set('memory_limit', '512M');

        $configuration = Configuration::getInstance();
        $configuration->__set('cache', NullCache::class);

        $doctrine = $this->getContainer()->get('doctrine');
        $itemRep = $doctrine->getManager()->getRepository(Item::class);

        $esi = new Eseye();

        $startingId = $input->getArgument('startWith');

        $items = $itemRep->findAll();


        /**
         * @var Item $item
         */
        foreach ($items as $item){
            if($startingId <= $item->getId()){
                try{
                    $itemData = EsiUtil::callESI($esi, 'get', '/universe/types/{type_id}/', array('type_id' => $item->getId()));
                    $skillRep = $doctrine->getManager()->getRepository(Skill::class);


                    if(isset($itemData->dogma_attributes)){
                        $dogmas = $itemData->dogma_attributes;

                        $skillsMapping = array();
                        $skillsMapping['skill1'] = array();
                        $skillsMapping['skill2'] = array();
                        $skillsMapping['skill3'] = array();

                        foreach ($dogmas as $dogma){
                            if( $dogma->attribute_id == CCPConfig::$skill1DogmaLevel) $skillsMapping['skill1']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill2DogmaLevel) $skillsMapping['skill2']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill3DogmaLevel) $skillsMapping['skill3']['level'] = $dogma->value;

                            if( $dogma->attribute_id == CCPConfig::$skill1DogmaId) $skillsMapping['skill1']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill2DogmaId) $skillsMapping['skill2']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill3DogmaId) $skillsMapping['skill3']['id'] = $dogma->value;
                        }

                        if(count($skillsMapping['skill1']) == 2 ){
                            $item->setSkill1($skillRep->find($skillsMapping['skill1']['id']));
                            $item->setSkill1Level($skillsMapping['skill1']['level']);
                        }

                        if(count($skillsMapping['skill2']) == 2 ){
                            $item->setSkill2($skillRep->find($skillsMapping['skill2']['id']));
                            $item->setSkill2Level($skillsMapping['skill2']['level']);
                        }

                        if(count($skillsMapping['skill3']) == 2 ){
                            $item->setSkill3($skillRep->find($skillsMapping['skill3']['id']));
                            $item->setSkill3Level($skillsMapping['skill3']['level']);
                        }

                        $doctrine->getManager()->persist($item);
                        $doctrine->getManager()->flush();
                        $output->writeln(date("Y-m-d h:i:s") . ' : update de ' . $item->getId() . ' -> ' . $item->getName());
                    }

                }
                catch (EsiException $e){
                    dump($e);
                }
                catch (\Exception $e){
                    dump($e);
                }
            }



        }
    }
}