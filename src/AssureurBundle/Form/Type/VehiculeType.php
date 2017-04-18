<?php

namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use \Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class VehiculeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('matricule', TextType::class);

        $builder->add('marque', TextType::class);

        $builder->add('modele', TextType::class);

        $builder->add('type_id', TextType::class);

        $builder->add('n_contrat_assur', TextType::class);

        $builder->add('nom_assurance', TextType::class);

        $builder->add('num_attestation', TextType::class);

        $builder->add('num_police', TextType::class);

        $builder->add('valable_du', DateType::class, array('widget' => 'single_text', 'format' => "yyyy-mm-dd"));

        $builder->add('valable_au', DateType::class, array('widget' => 'single_text', 'format' => "yyyy-mm-dd"));

        $builder->add('ag_bur_court', TextType::class);



        $builder->add('userId', TextType::class);
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
