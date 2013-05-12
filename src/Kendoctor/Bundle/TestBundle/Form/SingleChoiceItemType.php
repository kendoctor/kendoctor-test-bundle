<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kendoctor\Bundle\TestBundle\Form\ChoiceItemType;

class SingleChoiceItemType extends ChoiceItemType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);               
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\SingleChoiceItem'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_singlechoiceitemtype';
    }
}
