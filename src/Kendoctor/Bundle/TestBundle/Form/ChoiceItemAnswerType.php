<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoiceItemAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer')   
            ->add('isCorrect', null, array('required'=>false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_choiceitemanswertype';
    }
}
