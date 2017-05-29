<?php

namespace ApiUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use ApiUserBundle\Entity\User;
class ProfileFormType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('phone');
        $builder->add('dateNaissance',DateType::class,array(
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'd-M-y'
        ));
        $builder->add('cin');
        $builder->add('adresse');
        $builder->add('photo',FileType::class);
    }

    /*public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }*/

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'user_profile';
    }

}
