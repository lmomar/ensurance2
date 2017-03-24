<?php

namespace ApiUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\DependencyInjection\Container;
class ProfileFormType extends AbstractType {

    private $class;

    
    public function __construct(Container $container, $class) {
        
        $request = $container->get('request');
        
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('phone');
        $builder->add('date_naissance', DateType::class);
        $builder->add('date_driver_license', DateType::class);
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => "ApiUserBundle\Entity\User",
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    public function getBlockPrefix() {
        return 'user_profile';
    }

}
