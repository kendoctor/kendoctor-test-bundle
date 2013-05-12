<?php

namespace Kendoctor\Bundle\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kendoctor\Bundle\TestBundle\Form\QuestionItemType;

class ChoiceItemType extends QuestionItemType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {       
        parent::buildForm($builder, $options);

        $builder
            ->add('ChoiceItemAnswers', 'collection',
                    array(
                        'type' => new ChoiceItemAnswerType(),
                        'allow_add' => true,
                        'by_reference' => false
                    ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kendoctor\Bundle\TestBundle\Entity\ChoiceItem'
        ));
    }

    public function getName()
    {
        return 'kendoctor_bundle_testbundle_choiceitemtype';
    }
}
