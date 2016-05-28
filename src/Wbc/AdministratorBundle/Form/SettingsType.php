<?php

namespace Wbc\AdministratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['attr' => ['class' => 'form-control']])
            ->add('url', null, ['attr' => ['class' => 'form-control']])
            ->add('html_robots', null, ['attr' => ['class' => 'form-control']])
            ->add('og_title', null, ['attr' => ['class' => 'form-control']])
            ->add('active', null, ['attr' => ['class' => '']])

            ->add('use_email', null, ['attr' => ['class' => '']])
            ->add('use_twilio', null, ['attr' => ['class' => '']])
            ->add('use_twilio_voice', null, ['attr' => ['class' => '']])
            ->add('is_production', null, ['attr' => ['class' => '']])
            ->add('use_translations', null, ['attr' => ['class' => '']])

            ->add('email', null, ['attr' => ['class' => 'form-control']])
            ->add('facebook_url', null, ['attr' => ['class' => 'form-control']])
            ->add('twitter_url', null, ['attr' => ['class' => 'form-control']])
            ->add('youtube_url', null, ['attr' => ['class' => 'form-control']])
            ->add('instagram_url', null, ['attr' => ['class' => 'form-control']])
            ->add('facebook_app_id', null, ['attr' => ['class' => 'form-control']])

            ->add('copyright', null, ['attr' => ['class' => 'form-control']])
            ->add('main_api', null, ['attr' => ['class' => 'form-control']])
            ->add('twilio_number', null, ['attr' => ['class' => 'form-control']])
            ->add('twilio_sid', null, ['attr' => ['class' => 'form-control']])
            ->add('admin_email', null, ['attr' => ['class' => 'form-control']])
            ->add('faye_server_url', null, ['attr' => ['class' => 'form-control']])

            ->add('twilio_token', null, ['attr' => ['class' => 'form-control']])
            ->add('analytics_script', null, ['attr' => ['class' => 'form-control']])
            ->add('description', null, ['attr' => ['class' => 'form-control']])
            ->add('og_description', null, ['attr' => ['class' => 'form-control']])
            ->add('og_image_url', null, ['attr' => ['class' => 'form-control']])
            ->add('og_url', null, ['attr' => ['class' => 'form-control']])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbc\AdministratorBundle\Entity\Settings'
        ));
    }
}
