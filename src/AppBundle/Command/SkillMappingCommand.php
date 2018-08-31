<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 15/07/2018
 * Time: 14:43
 */


namespace AppBundle\Command;


use AppBundle\CCP\CCPConfig;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\Item;
use AppBundle\Entity\ItemGroup;
use AppBundle\Entity\Skill;
use AppBundle\Entity\SkillLevel;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SkillMappingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:skill')

            // the short description shown while running "php bin/console list"
            ->setDescription('Skill mapping.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        ini_set('memory_limit', '512M');

        $configuration = Configuration::getInstance();
        $configuration->__set('cache', NullCache::class);

        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $itemRep = $doctrine->getManager()->getRepository(Item::class);
        $groupRep = $doctrine->getManager()->getRepository(ItemGroup::class);
        $skillRep = $doctrine->getManager()->getRepository(Skill::class);

        $esi = new Eseye();

        $groups = $groupRep->findByCategory(16); //TODO global variable

        $skillItems = $itemRep->findByItemGroup($groups);

        //dump($skills);

        /**
         * @var Item $skillItem
         */
        foreach ($skillItems as $skillItem){
            $skillData = EsiUtil::callESI($esi, 'get', '/universe/types/{type_id}/', array('type_id' => $skillItem->getId()));

            $skill = $skillRep->find($skillItem->getId());
            if($skill == null){
                $skill = new Skill();
                $skill->setId($skillItem->getId());
            }
            $skill->setName($skillItem->getName());


            $dogmas = $skillData->dogma_attributes;

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

                if( $dogma->attribute_id == CCPConfig::$timeMultiplierDogmaId) $skill->setTimeMultiplier($dogma->value);

                if( $dogma->attribute_id == CCPConfig::$primaryAttributeDogmaId) $skill->setPrimaryAttribute(CCPConfig::$attributeMapping[$dogma->value]);
                if( $dogma->attribute_id == CCPConfig::$secondaryAttributeDogmaId) $skill->setSecondaryAttribute(CCPConfig::$attributeMapping[$dogma->value]);
            }

            foreach ($skill->getSkills() as $OldSkill)
                $doctrine->getManager()->remove($OldSkill);

            if(count($skillsMapping['skill1']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill1']['id']))->setLevel($skillsMapping['skill1']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }

            if(count($skillsMapping['skill2']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill2']['id']))->setLevel($skillsMapping['skill2']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }

            if(count($skillsMapping['skill3']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill3']['id']))->setLevel($skillsMapping['skill3']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }

            if(count($skillsMapping['skill4']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill4']['id']))->setLevel($skillsMapping['skill4']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }

            if(count($skillsMapping['skill5']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill5']['id']))->setLevel($skillsMapping['skill5']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }

            if(count($skillsMapping['skill6']) == 2 ){
                $skillLevel = new SkillLevel();
                $skillLevel->setSkill($skillRep->find($skillsMapping['skill6']['id']))->setLevel($skillsMapping['skill6']['level'])->setParent($skill);
                $em->persist($skillLevel);
                $skill->addSkill($skillLevel);
            }


            //dump($dogma);

            $skill->setGroup($skillItem->getItemGroup());


            $doctrine->getManager()->persist($skill);

        }
        $doctrine->getManager()->flush();



    }
}