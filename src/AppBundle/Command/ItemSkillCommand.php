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
use AppBundle\Entity\SkillLevelItem;
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
        $em = $doctrine->getManager();
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
                        $skillsMapping['skill4'] = array();
                        $skillsMapping['skill5'] = array();
                        $skillsMapping['skill6'] = array();


                        foreach ($dogmas as $dogma){

                            if( $dogma->attribute_id == CCPConfig::$skill1DogmaLevel) $skillsMapping['skill1']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill2DogmaLevel) $skillsMapping['skill2']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill3DogmaLevel) $skillsMapping['skill3']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill4DogmaLevel) $skillsMapping['skill4']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill5DogmaLevel) $skillsMapping['skill5']['level'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill6DogmaLevel) $skillsMapping['skill6']['level'] = $dogma->value;

                            if( $dogma->attribute_id == CCPConfig::$skill1DogmaId) $skillsMapping['skill1']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill2DogmaId) $skillsMapping['skill2']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill3DogmaId) $skillsMapping['skill3']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill4DogmaId) $skillsMapping['skill4']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill5DogmaId) $skillsMapping['skill5']['id'] = $dogma->value;
                            if( $dogma->attribute_id == CCPConfig::$skill6DogmaId) $skillsMapping['skill6']['id'] = $dogma->value;
                        }

                        foreach ($item->getSkills() as $OldSkill)
                            $doctrine->getManager()->remove($OldSkill);

                        if(count($skillsMapping['skill1']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill1']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill1']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }

                        }

                        if(count($skillsMapping['skill2']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill2']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill2']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }

                        }

                        if(count($skillsMapping['skill3']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill3']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill3']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }

                        }

                        if(count($skillsMapping['skill4']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill4']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill4']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }
                        }

                        if(count($skillsMapping['skill5']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill5']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill5']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }

                        }

                        if(count($skillsMapping['skill6']) == 2 ){
                            $skill = $skillRep->find($skillsMapping['skill6']['id']);
                            if($skill != null){
                                $skillLevel = new SkillLevelItem();
                                $skillLevel->setSkill($skill)->setLevel($skillsMapping['skill6']['level'])->setItem($item);
                                $em->persist($skillLevel);
                                $item->addSkill($skillLevel);
                            }

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