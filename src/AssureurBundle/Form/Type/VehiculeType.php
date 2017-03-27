<?php

namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VehiculeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('matricule', TextType::class);
        $builder->add('marque', TextType::class);
        $builder->add('modele', TextType::class);
        $builder->add('num_carte_grise', TextType::class);
        $builder->add('user_id', TextType::class);
        $builder->add('type_id', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
                [
                    'data_class' => 'AssureurBundle\Entity\Vehicule'
                ]
        );
    }
    
    public function getName() {
        return 'Vehicule';
    }

}
