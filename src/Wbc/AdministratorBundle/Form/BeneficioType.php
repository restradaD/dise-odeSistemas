<?php

namespace Wbc\AdministratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeneficioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bono14', null, ['attr' => ['class' => 'select2 form-control']])
            ->add('aguinaldo', null, ['attr' => ['class' => 'select2 form-control']])
            ->add('bonificacionIncentivo', null, ['attr' => ['class' => 'select2 form-control']])
            ->add('descripcion', null, ['attr' => ['class' => 'form-control']])
//            ->add('fechaCreacion', DateTimeType::class, ['format' => 'yyyy-MM-dd HH:mm', 'widget' => 'single_text', 'attr' => ['class' => 'datetimepicker form-control']])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbc\AdministratorBundle\Entity\Beneficio'
        ));
    }
}
