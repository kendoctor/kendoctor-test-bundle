<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kendoctor\Bundle\TestBundle\Form\QuestionItemType;

class ItemGroupItemType extends AbstractType
{
    private $questionItemType;
    
    public function __construct(QuestionItemType $questionItemType)
    {
        $this->questionItemType = $questionItemType;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder                    
            ->add('QuestionItem' , $this->questionItemType)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_itemgroupitemtype';
    }
}
