<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 27/07/2017
 * Time: 17:09
 */

namespace AppBundle\Util;


use AppBundle\Entity\Item;
use AppBundle\Entity\ItemGroup;
use AppBundle\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Util
{


    public static $corpId = '98491538';


    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @param array(ItemGroup) $groups
     */
    public static function getChild(array $groups, array $json){

        if ($groups == null){
            return $json;

        }
        else{
            $json['children'] = array();


            /**
             * @var ItemGroup $group
             */
            foreach ($groups as $group){
                $tmp = array();
                $tmp['text'] = $group->getName();

                if($group->getSons()->isEmpty()){
                    /**
                     * @var Item $item
                     */
                    foreach ($group->getItems()->getValues() as $item){
                        $tmp['children'][] = array('text' => $item->getName(), 'a_attr' => array('href' => 'item/' . $item->getId()) ); //TODO

                    }
                    $json['children'][] = $tmp;
                }
                else{
                    $tmp = Util::getChild($group->getSons()->toArray(), $tmp);
                    $json['children'][] = $tmp;
                }




            }
        }

        return $json;
    }

    public static function getEvePraisal($data, ItemRepository $itemRep){

        $string = "";

        for ( $i=0 ; $i<count($data['items']) ; $i++) {

            /**
             * @var Item $item
             */
            $item = $itemRep->find($data['items'][$i]);
            $string = $string . rawurlencode($item->getName()) . "%20".$data['quantity'][$i]."%0A";

        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://evepraisal.com/appraisal.json?market=jita&raw_textarea=" . $string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            die( 'Error:' . curl_error($ch));
        }
        curl_close ($ch);

        return $result;


    }



}