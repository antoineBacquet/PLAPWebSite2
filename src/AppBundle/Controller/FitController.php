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
use AppBundle\Entity\Skill;
use AppBundle\Entity\SkillLevel;
use AppBundle\Entity\SkillLevelItem;
use AppBundle\Entity\SkillSet;
use AppBundle\Entity\SkillSetData;
use AppBundle\Util\ControllerUtil;
use Seat\Eseye\Eseye;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FitController
 * @package AppBundle\Controller
 * @Security("has_role('ROLE_MEMBER')")
 */
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
     * @Security("has_role('ROLE_FIT')")
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
            throw $this->createAccessDeniedException('Cette api ne t\'apartien-t pas.');
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

            $fitData->hasSkill = true;
            /**
             * @var SkillSetData $skill
             */

            $itemSkills = $this->getSkillsFromItem($item);
            //dump($item->getName());
            //dump($item);
            foreach ($itemSkills as $skill){
                //dump($itemSkills);

                if(!isset($apiSkills[$skill['skill']->getId()]) or $skill['level'] > $apiSkills[$skill['skill']->getId()]){
                    //Il n'as pas les skills
                    //dump('lel');
                    $fitData->hasSkill = false;
                    if(!isset($fitData->missingSkills)) $fitData->missingSkills = array();
                    $fitData->missingSkills[] = array(
                        'skill' => $skill['skill'],
                        'levelNeeded' => $skill['level'],
                        'actualLevel' => isset($apiSkills[$skill['skill']->getId()])?$apiSkills[$skill['skill']->getId()]:0);
                }
            }

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
     * @Security("has_role('ROLE_FIT')")
     */
    public function fitSkillSetAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);

        $em = $this->getDoctrine()->getManager();

        $skillSetDataRep = $em->getRepository(SkillSetData::class);

        if($fit->getSkillsSet() == null){

            $skillSet = new SkillSet();
            $skillSet->setFit($fit);

            $skills = $this->getSkills($fit);

            foreach ($skills as $skill){
                $skillSetData = new SkillSetData();
                $skillSetData->setLevel($skill['level'])->setMinimumLevel($skill['level'])->setSkill($skill['skill'])->setSkillSet($skillSet);
                $em->persist($skillSetData);
            }

            //dump($skills);

            $em->persist($skillSet);
            $fit->setSkillsSet($skillSet);
            $em->persist($fit);
            $em->flush();
        }
        else{
            $skillSet = $fit->getSkillsSet();
        }

        $form = $this->createFormBuilder()
            ->add('levels', CollectionType::class, array('entry_type'   => HiddenType::class,
                'allow_add' => true, 'label' => ''))
            ->add('skills', CollectionType::class, array('entry_type'   => HiddenType::class,
                'allow_add' => true, 'label' => ''))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer',  'attr' => array(
                'class' => 'btn-admin')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            for( $i = 0 ; $i < count($data['skills']) ; $i++){
                $tmp = $skillSetDataRep->find($data['skills'][$i]);
                if($tmp != null){
                    $tmp->setLevel($data['levels'][$i]);
                    $em->persist($tmp);
                    $em->flush();
                    dump($data['skills'][$i] . ' - ' . $data['levels'][$i]);
                }
            }
            //dump($data);
        }

        $groups = array();

        /**
         * @var SkillSetData $skill
         */
        foreach ($skillSet->getSkills() as $skill){

            if(!isset($groups[$skill->getSkill()->getGroup()->getid()])){
                $groups[$skill->getSkill()->getGroup()->getid()] = array();
                $groups[$skill->getSkill()->getGroup()->getid()]['group'] = $skill->getSkill()->getGroup();
                $groups[$skill->getSkill()->getGroup()->getid()]['skills'] = array();
            }
            $groups[$skill->getSkill()->getGroup()->getid()]['skills'][$skill->getSkill()->getId()] = $skill;

            $skills[$skill->getSkill()->getId()] = $skill;

            $parameters['groups'] = $groups;

        }

        $parameters['form'] = $form->createView();

        $parameters['fit'] = $fit;

        return $this->render('fit/fit-skill-set.html.twig', $parameters);

    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/fit/skillbar/{id}", name="fit-skill-bar")
     * @ParamConverter(name="fit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function fitSkillBarAction(Request $request, Fit $fit)
    {
        $parameters = ControllerUtil::before($this);



        $result = $this->getFitSkillState($fit, $this->getUser()->getApis()[0]);
        dump($result);

        $parameters['result'] = $result;


        return $this->render('fit/fit-skillbar.html.twig', $parameters);

    }

    private function getSkills(Fit $fit){
        $skills = array();

        /**
         * @var FitData $fitData
         */
        foreach ($fit->getFitDatas() as $fitData){

            /**
             * @var SkillLevelItem $skill
             */
            foreach ($fitData->getItem()->getSkills() as $skill){
                if(!isset($skills[$skill->getSkill()->getId()])) {
                    $skills[$skill->getSkill()->getId()] = array();
                    $skills[$skill->getSkill()->getId()]['level'] = $skill->getLevel();
                    $skills[$skill->getSkill()->getId()]['skill'] = $skill->getSkill();
                }
                if($skills[$skill->getSkill()->getId()]['level'] < $skill->getLevel())
                    $skills[$$skill->getSkill()->getId()]['level'] = $skill->getLevel();

                $this->addSkill($skill->getSkill(), $skills);
            }
        }

        return $skills;
    }

    private function getSkillsFromItem(Item $item, &$skills = null){
        if($skills == null) $skills = array();

        /**
         * @var SkillLevelItem $skill
         */
        foreach ($item->getSkills() as $skill){
            if(!isset($skills[$skill->getSkill()->getId()])) {
                $skills[$skill->getSkill()->getId()] = array();
                $skills[$skill->getSkill()->getId()]['level'] = $skill->getLevel();
                $skills[$skill->getSkill()->getId()]['skill'] = $skill->getSkill();
            }
            if($skills[$skill->getSkill()->getId()]['level'] < $skill->getLevel())
                $skills[$skill->getSkill()->getId()]['level'] = $skill->getLevel();

            $this->addSkill($skill->getSkill(), $skills);
        }

        return $skills;
    }

    private function addSkill(Skill $skill, &$skills){

        /**
         * @var SkillLevel $skillLevel
         */
        foreach ($skill->getSkills() as $skillLevel){
            if(!isset($skills[$skillLevel->getSkill()->getId()])) {
                $skills[$skillLevel->getSkill()->getId()] = array();
                $skills[$skillLevel->getSkill()->getId()]['level'] = $skillLevel->getLevel();
                $skills[$skillLevel->getSkill()->getId()]['skill'] = $skillLevel->getSkill();
            }
            if($skills[$skillLevel->getSkill()->getId()]['level'] < $skillLevel->getLevel())
                $skills[$skillLevel->getSkill()->getId()]['level'] = $skillLevel->getLevel();

            $this->addSkill($skillLevel->getSkill(), $skills);
        }
    }




    private function getFitSkillState(Fit $fit, CharApi $api){

        $auth = EsiUtil::getDefaultAuthentication($api->getRefreshToken());
        $esi = new Eseye($auth);

        $apiSkillsData = EsiUtil::callESI($esi, 'get', '/characters/{character_id}/skills/', array('character_id' => $api->getCharId()));

        $apiSkills = array();

        foreach ($apiSkillsData->getArrayCopy()['skills'] as $apiSkillData){
            $apiSkills[$apiSkillData->skill_id] = array(
                'level' => $apiSkillData->trained_skill_level,
                'skillpoints' => $apiSkillData->skillpoints_in_skill
            );
        }

        $result = array();


        //Ship skills
        $shipSkills = $this->getSkillsFromItem($fit->getShip());
        dump($shipSkills);
        $result['ship'] = $this->getMissingSP($shipSkills, $apiSkills);
        $result['ship']['total-sp'] = $this->getSkillsSP($shipSkills);


        return $result;

    }

    private function getSkillsSP($skills){
        $sp = 0;

        foreach ($skills as $skill){
            $sp = $sp + (( 250 * $skill['skill']->getTimeMultiplier() * (pow(sqrt(32),$skill['level']-1))));
        }

        return $sp;
    }

    private function getMissingSP($skills, $apiSkills){
        $result = array('pass' => true, 'missingSkillPoint' => 0, 'missingSkills' => array());

        foreach ($skills as $skill){
            $skillId = $skill['skill']->getId();
            $skillLevel = $skill['level'];

            if(!isset($apiSkills[$skillId]) or $skillLevel > $apiSkills[$skillId]['level']){
                $result['pass'] = false;
                $result['missingSkills'][] = $skill['skill'];
                $skillpoints = isset($apiSkills[$skillId]) ? $apiSkills[$skillId]['skillpoints'] : 0 ;

                $result['missingSkillPoint'] = $result['missingSkillPoint']
                    + (( 250 * $skill['skill']->getTimeMultiplier() * (pow(sqrt(32),$skillLevel-1)))
                        - $skillpoints);
            }
        }

        return $result;


    }







}