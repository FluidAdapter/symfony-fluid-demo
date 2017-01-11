<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DummyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Name'
            ))
            ->add('description', null, array(
                'label' => 'Description'
            ))
            ->add('number', null, array(
                'label' => 'Number'
            ))
            ->add('boolean', null, array(
                'label' => 'Boolean'
            ))
//            ->add('createdAt', null, array(
//                'label' => 'CreatedAd'
//            ))
            ->add('save', SubmitType::class, array('label' => 'Create Dummy'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dummy',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_dummy';
    }


}
