<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 09/09/2018
 * Time: 12:07
 */

namespace AppBundle\Controller;

use AppBundle\Entity\System;
use AppBundle\Util\ControllerUtil;
use AppBundle\Util\DiscordUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LogisticController
 * @package AppBundle\Controller
 * @Security("has_role('ROLE_MEMBER')")
 */
class LogisticController extends Controller
{

    /**
     *
     * This route is the homepage
     *
     * @Route("/logi/route/add", name="logi-add")
     */
    public function logiAddAction(Request $request, \AppBundle\Entity\Route $route = null)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $systemRep = $doctrine->getRepository(System::class);

        if($route === null)
            $route = new \AppBundle\Entity\Route();
        else{
            $parameters['start'] = $route->getStart();
            $parameters['end'] = $route->getEnd();
        }

        $form = $this->createFormBuilder($route)
            ->add('start', HiddenType::class, array('required' => true))
            ->add('end', HiddenType::class, array('required' => true) )
            ->add('maxSize', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('maxColat', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('price', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('danger1b', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('danger5b', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('danger10b', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('dangerMax', NumberType::class, array('attr' => array('style' => 'color:black')) )
            ->add('save', SubmitType::class, array('label' => 'Enregistrer',  'attr' => array(
                'class' => 'btn-admin')))
            ->getForm();

        $form->handleRequest($request);
        $form->getErrors();

        //dump($route);

        if ($form->isSubmitted() && $form->isValid()) {
            $route = $form->getData();
            dump($route);
            if($route->getStart() == null)
                $form->addError(new FormError('Tu doit ajouter un systeme de depart'));
            else  if($route->getEnd() == null)
                $form->addError(new FormError('Tu doit ajouter un systeme d\'arrivée'));
            else{
                $route->setStart($systemRep->find($route->getStart()));
                $route->setEnd($systemRep->find($route->getEnd()));
                $doctrine->getManager()->persist($route);
                $doctrine->getManager()->flush();

                return $this->redirect($this->generateUrl('logi-routes'));
            }



        }


        $parameters['form'] = $form->createView();

        return $this->render('logi/add.html.twig', $parameters);
    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/logi/route/edit/{route}", name="logi-edit")
     * @ParamConverter(name="route")
     */
    public function logiEditAction(Request $request, \AppBundle\Entity\Route $route)
    {
        return $this->logiAddAction($request, $route);
    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/logi/route/remove/{route}", name="logi-remove")
     * @ParamConverter(name="route")
     */
    public function logiRemoveAction(Request $request, \AppBundle\Entity\Route $route)
    {

        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();

        $doctrine->getManager()->remove($route);
        $doctrine->getManager()->flush();

        return $this->redirect($this->generateUrl('logi-routes'));
    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/logi/routes", name="logi-routes")
     */
    public function logiRoutesAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $routeRep = $doctrine->getRepository(\AppBundle\Entity\Route::class);

        $routes = $routeRep->findAll();
        $parameters['routes'] = $routes;

        return $this->render('logi/routes.html.twig', $parameters);

    }

    /**
     *
     * This route is the homepage
     *
     * @Route("/logi", name="logi")
     */
    public function indexAction(Request $request)
    {
        $parameters = ControllerUtil::before($this);

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $routeRep = $doctrine->getRepository(\AppBundle\Entity\Route::class);

        $routes = $routeRep->findAll();

        $form = $this->createFormBuilder()
            ->add('routes', ChoiceType::class, [
                'choices' => $routes ,
                'label' => 'Route',
                'choice_label' => function($route, $key, $value) {
                    return strtoupper($route->getStart()->getName() . ' -> ' . $route->getEnd()->getName());
                },
                'choice_value' => function($route) {
                    return $route ? $route->getId() : '-1';
                },
                'attr' => array('style' => 'color: black;', 'onchange' => 'update(this);')

            ])
            ->add('size', NumberType::class,
                array('attr' => array('style' => 'color:black', 'onkeyup' => 'updatePrice();', 'onpaste' => 'updatePrice();', 'min' => 1), 'data' => '1', 'label' => 'Taille'))
            ->add('colat', NumberType::class,
                array('attr' => array('style' => 'color:black', 'onkeyup' => 'updatePrice();', 'onpaste' => 'updatePrice();', 'min' => 1), 'data' => '1', 'label' => 'Colateral') )
            ->add('save', SubmitType::class, array('label' => 'Enregistrer',  'attr' => array(
                'class' => 'btn-admin')))
            ->getForm();

        $form->handleRequest($request);
        $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if($data['routes']->getId() == -1) {
                $form->addError(new FormError('Cette route est invalide'));
            }
            else if($data['size'] > $data['routes']->getMaxSize()){
                $form->addError(new FormError('La taille du contrat est trop elevé'));
            }
            else if($data['colat'] > $data['routes']->getMaxColat()) {
                $form->addError(new FormError('Le colateral est trop cher'));
            }
            else{
                //dump($data);
                $colat = $data['colat'];
                $route = $data['routes'];
                $size = $data['size'];

                if($colat >= 10000000000){
                    $danger = $route->getDangerMax();
                }
                else if($colat < 10000000000 && $colat >= 5000000000){
                    $danger = $route->getDanger10b();
                }
                else if($colat < 5000000000 && $colat >= 10000000000){
                    $danger = $route->getDanger5b();
                }
                else{
                    $danger = $route->getDanger1b();
                }

                $totalPrice = $danger + ($size * $route->getPrice());

                DiscordUtil::sendNewLogi($route, $this->getUser(), $totalPrice, $size, $colat);
            }


            //dump($totalPrice);
        }

        $parameters['routes'] = $routes;
        $parameters['form'] = $form->createView();

        return $this->render('logi/index.html.twig', $parameters);
    }
}