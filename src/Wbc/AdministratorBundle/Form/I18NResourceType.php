<?php

namespace Wbc\AdministratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class I18NResourceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->choices = ['text' => 'Text', 'image' => 'Image'];

        $builder
            ->add('name', null, ['attr' => ['class' => 'form-control']])
            ->add('slug', null, ['attr' => ['class' => 'form-control']])
            //->add('type', ChoiceType::class, ['required' => true, 'choices' => $this->choices, 'attr' => ['class' => 'select2 form-control']])
            ->add('type', HiddenType::class)
            ->add('locale', null, ['attr' => ['class' => 'select2 form-control']])
            //->add('logo', FileType::class, ['attr' => []])
            ->add('logo', HiddenType::class)
            ->add('content', null, ['attr' => ['class' => 'wysiwyg form-control', 'style' => 'height: 200px']])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbc\AdministratorBundle\Entity\I18NResource'
        ));
    }
}
