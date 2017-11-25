<?php
/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 18/11/2017
 * Time: 18:34
 */

namespace AppBundle\Controller;


use AppBundle\Discord\DiscordConfig;
use AppBundle\Entity\Item;
use AppBundle\Util\UserUtil;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AjaxController extends Controller
{
    /**
     * Get item information
     *
     * @Route("/ccpdata/item/search", name="searchitemajax")
     */
    public function ccpdataSearchItemAction(Request $request)
    {
        $text = $request->request->get('text');
        $response = "aze";
        if (strlen($text) > 0) {
            $words = explode(' ', $text);
            $whereSql = "";
            for ($i = 0; $i < count($words); $i++) {
                $whereSql = $whereSql . " upper(i.name) LIKE upper('%" . $words[$i] . "%') ";
                if ($i != (count($words) - 1))
                    $whereSql = $whereSql . " AND ";
            }
            //$response = $whereSql;
            $em = $this->getDoctrine()->getRepository(Item::class);
            $query = $em->createQueryBuilder('i')
                ->where($whereSql)
                ->orderBy('i.itemGroup', 'ASC')
                ->setMaxResults(10)
                ->getQuery();
            $results = $query->getResult();
            $response = array('results' => array());
            foreach ($results as $result){
                $response['results'][] = array('id' =>$result->getId(),  'name' =>$result->getName());
            }
        }
        return $this->json($response);
    }

    /**
     * Get item information
     *
     * @Route("/service/discord/test", name="testdiscord")
     */
    public function discordTestAction(Request $request)
    {
        /*
         *
         */
        $user = UserUtil::getUser($this->getDoctrine(), $request);

        $response = [];

        if($user == null){
            $response['error'] = true;
            $response['error_id'] = 1; // User not connected
        }
        else{
            if($user->getDiscordId() != null){

                $response['error'] = false;

                $webhook = new Client(DiscordConfig::$webhook_url);
                $embed = new Embed();

                $embed->description('Demande de test du discord');

                $webhook->username('Bot')->message('!test <@' . $user->getDiscordId() .'>')->embed($embed)->send();

                //TODO message de feedback
            }

            else{
                $response['error'] = true;
                $response['error_id'] = 2; // Not linked to the discord
            }
        }


        return $this->json($response);


    }


}