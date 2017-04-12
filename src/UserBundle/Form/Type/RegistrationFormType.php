<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('roles', ChoiceType::class, array(
            'choices' => array(
                'Client' => 'ROLE_USER',
                'Assureur' => 'ROLE_ADMIN',
                'Expert' => 'ROLE_EXPERT',
                'Constateur' => 'ROLE_CONSTATEUR',
                'Assistant' => 'ROLE_ASSISTANT'
            ),
            'multiple' => true,
            'expanded' => false
        ));

        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('phone');
        $builder->add('date_naissance', DateType::class, ['widget' => 'single_text']);
        $builder->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => "ApiUserBundle\Entity\User",
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    public function getBlockPrefix() {
        return 'assur_user_registration';
    }

}
