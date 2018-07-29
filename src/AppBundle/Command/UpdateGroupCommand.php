<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 29/07/2018
 * Time: 15:43
 */

namespace AppBundle\Command;


use AppBundle\CCP\EsiUtil;
use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use AppBundle\Entity\ItemGroup;
use AppBundle\Entity\ItemMarketGroup;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateGroupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:update:group')

            // the short description shown while running "php bin/console list"
            ->setDescription('Test.')

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
        $catRep = $doctrine->getRepository(Category::class);
        $groupRep = $doctrine->getRepository(ItemGroup::class);
        $marketGroupRep = $doctrine->getRepository(ItemMarketGroup::class);

        $esi = new Eseye();

        //------------------------ Category
        $catIds =  EsiUtil::callESI($esi, 'get', '/universe/categories/');

        foreach ($catIds as $catId){
            $catData = EsiUtil::callESI($esi, 'get', '/universe/categories/{category_id}/', array('category_id' => $catId));

            $cat = $catRep->find($catId);
            if($cat == null){
                $cat = new Category();
                $cat->setId($catId);
            }
            $cat->setName($catData->name);

            $output->writeln(date("Y-m-d h:i:s") . ' : update de la category ' . $catId . ' -> ' . $cat->getName());

            $doctrine->getManager()->persist($cat);
        }
        $doctrine->getManager()->flush();

        //------------------------ ItemGroup
        $groupIds =  EsiUtil::callESI($esi, 'get', '/universe/groups/');

        foreach ($groupIds as $groupId){
            $groupData = EsiUtil::callESI($esi, 'get', '/universe/groups/{group_id}/', array('group_id' => $groupId));

            $group = $groupRep->find($groupId);
            if($group == null){
                $group = new ItemGroup();
                $group->setId($groupId);
            }

            $group->setName($groupData->name)->setCategory($catRep->find($groupData->category_id));

            $output->writeln(date("Y-m-d h:i:s") . ' : update du groupe ' . $groupId . ' -> ' . $group->getName());

            $doctrine->getManager()->persist($group);
        }
        $doctrine->getManager()->flush();

        //------------------------ ItemMarketGroup
        $marketGroupIds =  EsiUtil::callESI($esi, 'get', '/markets/groups/');

        foreach ($marketGroupIds as $marketGroupId){
            //$marketGroupData = EsiUtil::callESI($esi, 'get', '/markets/groups/{market_group_id}/', array('market_group_id' => $marketGroupId));

            $marketGroup = $marketGroupRep->find($marketGroupId);
            if($marketGroup == null){
                $marketGroup = new ItemMarketGroup();
                $marketGroup->setId($marketGroupId);
                $marketGroup->setName('Groupe inconnue'); //TODO better
            }

            $output->writeln(date("Y-m-d h:i:s") . ' : update du matket ' . $marketGroupId );

            $doctrine->getManager()->persist($marketGroup);

        }

        $doctrine->getManager()->flush();


        foreach ($marketGroupIds as $marketGroupId){
            $marketGroupData = EsiUtil::callESI($esi, 'get', '/markets/groups/{market_group_id}/', array('market_group_id' => $marketGroupId));

            $marketGroup = $marketGroupRep->find($marketGroupId);

            $marketGroup->setName($marketGroupData->name);
            if(isset($marketGroupData->parent_group_id))$marketGroup->setParentGroup($marketGroupRep->find($marketGroupData->parent_group_id));

            $output->writeln(date("Y-m-d h:i:s") . ' : update des données du groupe ' . $marketGroupId . ' -> ' . $marketGroup->getName());

            $doctrine->getManager()->persist($marketGroup);


        }
        $doctrine->getManager()->flush();






    }
}