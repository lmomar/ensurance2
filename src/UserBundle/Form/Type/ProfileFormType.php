<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileFormType extends AbstractType {

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
        $builder->add('email');
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('adresse');
        $builder->add('phone');
        $builder->add('cin');
        $builder->add('dateNaissance', DateType::class, ['widget' => 'single_text']);
        $builder->add('enabled');
        $builder->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

    public function getParent() {
        return \FOS\UserBundle\Form\Type\ProfileFormType::class;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => "ApiUserBundle\Entity\User",
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    public function getBlockPrefix() {
        return 'fos_user_profile_edit';
    }

}
