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
        $itemRep = $doctrine->getManager()->getRepository(Item::class);
        $groupRep = $doctrine->getManager()->getRepository(ItemGroup::class);
        $skillRep = $doctrine->getManager()->getRepository(Skill::class);

        $esi = new Eseye();

        $groups = $groupRep->findByCategory(16);

        $skillItems = $itemRep->findByItemGroup($groups); //TODO global variable

        //dump($skills);

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

            foreach ($dogmas as $dogma){
                if( $dogma->attribute_id == CCPConfig::$skill1DogmaLevel) $skillsMapping['skill1']['level'] = $dogma->value;
                if( $dogma->attribute_id == CCPConfig::$skill2DogmaLevel) $skillsMapping['skill2']['level'] = $dogma->value;
                if( $dogma->attribute_id == CCPConfig::$skill3DogmaLevel) $skillsMapping['skill3']['level'] = $dogma->value;

                if( $dogma->attribute_id == CCPConfig::$skill1DogmaId) $skillsMapping['skill1']['id'] = $dogma->value;
                if( $dogma->attribute_id == CCPConfig::$skill2DogmaId) $skillsMapping['skill2']['id'] = $dogma->value;
                if( $dogma->attribute_id == CCPConfig::$skill3DogmaId) $skillsMapping['skill3']['id'] = $dogma->value;
            }

            if(count($skillsMapping['skill1']) == 2 ){
                $skill->setSkill1($skillRep->find($skillsMapping['skill1']['id']));
                $skill->setSkill1Level($skillsMapping['skill1']['level']);
            }

            if(count($skillsMapping['skill2']) == 2 ){
                $skill->setSkill2($skillRep->find($skillsMapping['skill2']['id']));
                $skill->setSkill2Level($skillsMapping['skill2']['level']);
            }

            if(count($skillsMapping['skill3']) == 2 ){
                $skill->setSkill3($skillRep->find($skillsMapping['skill3']['id']));
                $skill->setSkill3Level($skillsMapping['skill3']['level']);
            }


            //dump($dogma);

            $skill->setGroup($skillItem->getItemGroup());


            $doctrine->getManager()->persist($skill);

        }
        $doctrine->getManager()->flush();



    }
}