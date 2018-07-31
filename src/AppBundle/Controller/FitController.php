<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 07/07/2018
 * Time: 23:02
 */

namespace AppBundle\Controller;

use AppBundle\CCP\EsiUtil;
use AppBundle\Entity\CharApi;
use AppBundle\Entity\Fit;
use AppBundle\Entity\FitData;
use AppBundle\Entity\Item;
use AppBundle\Util\ControllerUtil;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class FitController extends Controller
{




    /**
     *
     * This route is the homepage
     *
     * @Route("/fit", name="fit-list")
     */
    public function indexAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $fitRep = $this->getDoctrine()->getRepository(Fit::class);

        $fits = $fitRep->findAll();

        $parameters['fits'] = $fits;

        return $this->render('fit/index.html.twig', $parameters);

    }



    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/add", name="fit-add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request){
        $parameters = ControllerUtil::before($this);

        $form = $this->createFormBuilder()
            ->add('data', TextareaType::class,
                array(
                    'label' => 'EFT fit',
                    'attr' => array('style' => 'color: black;', 'cols' => 50, 'rows' => 25))
            )
            ->add('save', SubmitType::class, array('label' => 'Send',  'attr' => array(
                'class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        $parameters['data'] = "";

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $itemRep = $this->getDoctrine()->getRepository(Item::class);

            $regex = '/\r\n/';
            $dataTable = preg_split($regex, $data['data']);
            dump($dataTable);

            $fit = new Fit();

            $patern = "/ x\d+/";

            $newBlock = true;
            $slotNum = 0;
            for( $i = 0 ; $i < count($dataTable) ; $i++){
                if($i === 0){
                    $headerRegex = '/\[([^,]+), ([^\]]+)\]/';
                    $headerData = array();
                    preg_match($headerRegex, $dataTable[0], $headerData);
                    $ship = $itemRep->findOneByName($headerData[1]);
                    $fitName = $headerData[2];// TODO error manegement
                    $fit->setShip($ship)->setName($fitName);
                    //dump($headerData);

                }else{
                    if(!$dataTable[$i] == "") {
                        $newBlock = false;
                        $output = array();
                        $number = 1;
                        $itemName = $dataTable[$i];
                        if(preg_match($patern, $dataTable[$i], $output)){
                            $number = $output[0];
                            $number = ltrim($number, ' x');
                            $itemName = preg_replace($patern, "", $dataTable[$i]);
                        }
                        $item = $itemRep->findOneByName($itemName);
                        if($item !== null){
                            $fitData = new FitData();
                            $fitData->setItem($item)->setQuantity($number)->setSlot($slotNum)->setFit($fit);
                            $fit->addFitData($fitData);
                        }
                        //dump($item);

                    }
                    else  if(!$newBlock and $dataTable[$i] === "") {
                        $newBlock = true;
                        $slotNum = $slotNum + 1;
                    }

                }
            }


            $this->getDoctrine()->getManager()->persist($fit);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('fit-details', array('id' => $fit->getId())));
        }

        $parameters['form']  = $form->createView();

        return $this->render('default/test.html.twig', $parameters); //TODO
    }

    /**
     *
     * Remove a fit
     *
     * @Route("/fit/remove/{id}", name="fit-remove")
     * @ParamConverter(name="fit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function fitRemoveAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);

        $this->getDoctrine()->getManager()->remove($fit);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('fit-list'));

    }


    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/{id}", name="fit-details")
     * @ParamConverter(name="fit")
     */
    public function fitAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);
        $parameters['fit'] = $fit;




        return $this->render('fit/fit.html.twig', $parameters);
    }


    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/{id}/skill/{api_id}", name="fit-skill-api")
     * @ParamConverter(name="fit")
     */
    public function fitSkillMappingAction(Request $request, Fit $fit, $api_id)
    {
        $parameters = ControllerUtil::before($this);

        $user = $this->getUser();

        $repApi = $this->getDoctrine()->getRepository(CharApi::class);
        /**
         * @var CharApi $api
         */
        $api = $repApi->find($api_id);


        if($api == null){
            throw $this->createNotFoundException('Api non trouvée dans la base de données');
        }
        if($api->getUser()->getId() ==! $user->getId()){
            throw $this->createAccessDeniedException('Cette api ne t\'apartient pas.');
        }

        $auth = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($auth);

        $apiSkillsData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/skills/', array('character_id' => $api->getCharId()));


        dump($apiSkillsData->getArrayCopy());
        $apiSkills = array();

        foreach ($apiSkillsData->getArrayCopy()['skills'] as $apiSkillData){
            $apiSkills[$apiSkillData->skill_id] = $apiSkillData->trained_skill_level;
        }

        dump($apiSkills);

        /**
         * @var FitData $fitData
         */
        foreach ($fit->getFitDatas() as $fitData){
            $item = $fitData->getItem();

            if($item->getSkill1() != null and (!isset($apiSkills[$item->getSkill1()->getId()]) or $item->getSkill1Level() > $apiSkills[$item->getSkill1()->getId()])){
                //Il n'as pas les skills
                $fitData->hasSkill = false;
            }
            else if($item->getSkill2() != null and (!isset($apiSkills[$item->getSkill1()->getId()]) or $item->getSkill2Level() > $apiSkills[$item->getSkill2()->getId()])){
                //Il n'as pas les skills
                $fitData->hasSkill = false;
            }
            else if($item->getSkill3() != null and (!isset($apiSkills[$item->getSkill1()->getId()]) or $item->getSkill2Level() > $apiSkills[$item->getSkill3()->getId()])){
                //Il n'as pas les skills
                $fitData->hasSkill = false;
            }
            else
                $fitData->hasSkill = true;

        }

        $parameters['fit'] = $fit;

        return $this->render('fit/fit-skill.html.twig', $parameters);
    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/slillset/{id}", name="fit-skill-set")
     * @ParamConverter(name="fit")
     */
    public function fitSkillSetAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);



    }







}