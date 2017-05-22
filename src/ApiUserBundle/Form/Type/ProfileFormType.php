<?php

namespace ApiUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\DependencyInjection\Container;
class ProfileFormType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('phone');
    }

    /*public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }*/

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => "ApiUserBundle\Entity\User",
            'allow_extra_fields' => true
        ));
    }

    public function getName() {
        return 'user_profile';
    }

}
