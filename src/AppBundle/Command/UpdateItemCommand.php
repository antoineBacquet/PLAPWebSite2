<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 15/07/2018
 * Time: 14:52
 */


namespace AppBundle\Command;


use AppBundle\CCP\EsiException;
use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\Item;
use AppBundle\Entity\ItemGroup;
use AppBundle\Entity\ItemMarketGroup;
use Seat\Eseye\Cache\NullCache;
use Seat\Eseye\Configuration;
use Seat\Eseye\Eseye;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateItemCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:updateItem')

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
        $itemRep = $doctrine->getRepository(Item::class);
        $groupRep = $doctrine->getRepository(ItemGroup::class);
        $marketGroupRep = $doctrine->getRepository(ItemMarketGroup::class);

        $esi = new Eseye();

        $page = 1;

        $items = array();

        do{
            $result = EsiUtil::callESI($esi, 'get', '/universe/types/',array() , array('page' => $page));
            $itemsResult = $result->getArrayCopy();
            foreach ($itemsResult as $id)
                $items[] = $id;

            $page = $page + 1 ;
        }while(count($itemsResult) > 0);


        dump($items);


        foreach ($items as $id){
            try{
                $itemData = EsiUtil::callESI($esi, 'get', '/universe/types/{type_id}/',array('type_id' => $id));
                if($itemData->published){
                    $item = $itemRep->find($id);

                    if($item == null) {
                        $item = new Item();
                        $item->setId($id);
                    }

                    $item->setName($itemData->name)->setItemGroup($groupRep->find($itemData->group_id))->setVolume($itemData->volume);
                    if(isset($itemData->market_group_id))$item->setItemMarketGroup($marketGroupRep->find($itemData->market_group_id));
                    if(isset($itemData->icon_id))$item->setIconId($itemData->icon_id);
                    if(isset($itemData->volume))$item->setVolume($itemData->volume);
                    else $item->setVolume(0);

                    $doctrine->getManager()->persist($item);
                    $doctrine->getManager()->flush();

                    $output->writeln(date("Y-m-d h:i:s") . ' : update de ' . $id . ' -> ' . $item->getName());
                    //dump($item->name);
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