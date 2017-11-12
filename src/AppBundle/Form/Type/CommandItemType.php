<?php

/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 05/11/2017
 * Time: 14:05
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandItemType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Standard Shipping' => 'standard',
                'Expedited Shipping' => 'expedited',
                'Priority Shipping' => 'priority',
            ),
            'choices_as_values' => true,
        ));
    }

    public function getParent()
    {
        return HiddenType::class;
    }

}