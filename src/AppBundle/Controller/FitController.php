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
use AppBundle\Entity\Doctrine;
use AppBundle\Entity\Fit;
use AppBundle\Entity\FitCategory;
use AppBundle\Entity\FitData;
use AppBundle\Entity\Item;
use AppBundle\Entity\SkillSet;
use AppBundle\Entity\SkillSetData;
use AppBundle\Util\ControllerUtil;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        $categoryRep = $this->getDoctrine()->getRepository(FitCategory::class);

        $categories = $categoryRep->findAll();

        $parameters['categories'] = $categories;

        return $this->render('fit/index.html.twig', $parameters);

    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/doctrine/{id}", name="fit-doctrine")
     *
     * @ParamConverter(name="doctrine")
     */
    public function doctrineAction(Request $request, Doctrine $doctrine){

        $parameters = ControllerUtil::before($this);

        $parameters['doctrine'] = $doctrine;

        return $this->render('fit/doctrine.html.twig', $parameters);
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

        $em = $this->getDoctrine()->getManager();
        $doctrineRep = $em->getRepository(Doctrine::class);

        $doctrines = $doctrineRep->findAll();


        $form = $this->createFormBuilder()
            ->add('doctrine', ChoiceType::class,
                array(
                    'choices' => $doctrines,
                    'choice_label' => function($doctrine, $key, $value) {
                        /** @var Doctrine $doctrine */
                        return strtoupper($doctrine->getName() . ' (' . $doctrine->getCategory()->getName() . ')');
                    },
                    'attr' => array('style' => 'color: black;')))
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

            $fit = new Fit();
            $fit->setDoctrine($doctrineRep->find($data['doctrine']));

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

        return $this->render('fit/add.html.twig', $parameters); //TODO
    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/admin", name="fit-admin")
     * @Security("has_role('ROLE_FIT')")
     */
    public function fitAdminAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $em = $this->getDoctrine()->getManager();
        $catRep = $em->getRepository(FitCategory::class);
        $doctrineRep = $em->getRepository(Doctrine::class);

        $cat = new FitCategory();
        $doctrine = new Doctrine();

        $categories = $catRep->findAll();

        $catForm = $this->createFormBuilder($cat)
            ->add('name', TextType::class,
                array(
                    'label' => 'Nom de la category',
                    'attr' => array('style' => 'color: black;', 'id' =>'catName'))
            )
            ->add('catSave', SubmitType::class, array('label' => 'Ajouter',  'attr' => array(
                'class' => 'btn btn-primary')))
            ->getForm();

        $doctrineForm = $this->createFormBuilder($doctrine)
            ->add('name', TextType::class,
                array(
                    'label' => 'Nom de la doctrine',
                    'attr' => array('style' => 'color: black;'))
            )
            ->add('category', ChoiceType::class,
                array(
                    'choices' => $categories,
                    'choice_label' => function($category, $key, $value) {
                        /** @var FitCategory $category */
                        return strtoupper($category->getName());
                    },
                    'attr' => array('style' => 'color: black;')))
            ->add('doctSave', SubmitType::class, array('label' => 'Ajouter',  'attr' => array(
                'class' => 'btn btn-primary')))
            ->getForm();



        $catForm->handleRequest($request);
        $doctrineForm->handleRequest($request);

        if($catForm->isSubmitted() && $catForm->isValid()) {
            $em->persist($cat);
            $em->flush();
        }

        if($doctrineForm->isSubmitted() && $doctrineForm->isValid()) {
            $em->persist($doctrine);
            $em->flush();
        }


        $categories = $catRep->findAll();
        $doctrines = $doctrineRep->findAll();

        $parameters['catForm'] = $catForm->createView();
        $parameters['doctrineForm'] = $doctrineForm->createView();
        $parameters['categories'] = $categories;
        $parameters['doctrines'] = $doctrines;


        return $this->render('fit/admin.html.twig', $parameters);


    }

    /**
     *
     * Remove a fit
     *
     * @Route("/fit/remove/{id}", name="fit-remove")
     * @ParamConverter(name="fit")
     * @Security("has_role('ROLE_FIT')")
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


        $apiSkills = array();

        foreach ($apiSkillsData->getArrayCopy()['skills'] as $apiSkillData){
            $apiSkills[$apiSkillData->skill_id] = $apiSkillData->trained_skill_level;
        }

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
     * @Route("/fit/skillset/{id}", name="fit-skill-set")
     * @ParamConverter(name="fit")
     */
    public function fitSkillSetAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);

        $em = $this->getDoctrine()->getManager();

        if($fit->getSkillsSet() == null){

            $skillSet = new SkillSet();
            $skillSet->setFit($fit);

            $skills = array();

            /**
             * @var FitData $fitData
             */
            foreach ($fit->getFitDatas() as $fitData){

                $item = $fitData->getItem();

                if($fitData->getItem()->getSkill1() != null){
                    if(!isset($skills[$item->getSkill1()->getId()])) {
                        $skills[$item->getSkill1()->getId()] = array();
                        $skills[$item->getSkill1()->getId()]['level'] = $item->getSkill1Level();
                        $skills[$item->getSkill1()->getId()]['skill'] = $item->getSkill1();
                    }
                    if($skills[$item->getSkill1()->getId()]['level'] < $item->getSkill1Level())
                        $skills[$item->getSkill1()->getId()]['level'] = $item->getSkill1Level();

                }

                if($fitData->getItem()->getSkill2() != null){
                    if(!isset($skills[$item->getSkill2()->getId()])) {
                        $skills[$item->getSkill2()->getId()] = array();
                        $skills[$item->getSkill2()->getId()]['level'] = $item->getSkill2Level();
                        $skills[$item->getSkill2()->getId()]['skill'] = $item->getSkill2();
                    }
                    if($skills[$item->getSkill2()->getId()]['level'] < $item->getSkill2Level())
                        $skills[$item->getSkill2()->getId()]['level'] = $item->getSkill2Level();

                }

                if($fitData->getItem()->getSkill3() != null){
                    if(!isset($skills[$item->getSkill3()->getId()])) {
                        $skills[$item->getSkill3()->getId()] = array();
                        $skills[$item->getSkill3()->getId()]['level'] = $item->getSkill3Level();
                        $skills[$item->getSkill3()->getId()]['skill'] = $item->getSkill3();
                    }
                    if($skills[$item->getSkill3()->getId()]['level'] < $item->getSkill3level())
                        $skills[$item->getSkill3()->getId()]['level'] = $item->getSkill3Level();

                }
            }

            foreach ($skills as $skill){
                $skillSetData = new SkillSetData();
                $skillSetData->setLevel($skill['level'])->setSkill($skill['skill'])->setSkillSet($skillSet);
                $em->persist($skillSetData);
            }

            $em->persist($skillSet);
            $fit->setSkillsSet($skillSet);
            $em->persist($fit);
            $em->flush();
        }

        //$form = $this->createFormBuilder()

        foreach ($skillSet->getSkills() as $skillData){

        }

        $parameters['fit'] = $fit;



    }







}