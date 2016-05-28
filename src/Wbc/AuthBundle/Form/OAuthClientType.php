<?php

namespace Wbc\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OAuthClientType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $types = ['token' => 'token', 'authorization_code' => 'authorization_code'];

        $builder
            ->add('name', null, ['attr' => ['class' => 'form-control']])
            ->add('types', ChoiceType::class, ['choices' => $types, 'multiple' => true, 'expanded' => false, 'required'  => true, 'attr' => ['class' => 'select2 form-control']])
            ->add('url', TextareaType::class, ['label' => 'URLs', 'attr' => ['class' => 'form-control']])

        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbc\AuthBundle\Entity\OAuthClient'
        ));
    }
}
