<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kendoctor\Bundle\TestBundle\Entity\ItemGroup;
use Kendoctor\Bundle\TestBundle\Form\ItemGroupItemType;

class ItemGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', 'text')
            ->add('type', 'hidden')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\ItemGroup'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_itemgrouptype';
    }
}
