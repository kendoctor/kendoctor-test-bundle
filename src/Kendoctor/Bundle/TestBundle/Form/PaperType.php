<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kendoctor\Bundle\TestBundle\Form\ItemGroupType;

class PaperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
         
          //  ->add('createdAt')
         //   ->add('updatedAt')
         //   ->add('isPublished')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\Paper'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_papertype';
    }
}
