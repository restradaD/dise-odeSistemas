<?php

namespace Wbc\AdministratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('locale', null, array('required' => true, 'attr' => ['data-placeholder' => 'Select locale', 'data-ui-jq' => 'select2']))
            ->add('username')
            ->add('email')
            ->add('password', null, array('required' => false, 'attr' => ['autocomplete' => 'off']))
            ->add('greeting', null, array('required' => false))
            ->add('timezone', null, array('required' => true))
            ->add('role', null, array('required' => true))
            ->add('expired')
            ->add('locked')
            ->add('enabled')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbc\AdministratorBundle\Entity\User'
        ));
    }
}
