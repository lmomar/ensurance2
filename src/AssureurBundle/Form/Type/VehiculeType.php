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

        $builder->add('typeId', TextType::class);

        $builder->add('nContratAssur', TextType::class);

        $builder->add('nomAssurance', TextType::class);

        $builder->add('numAttestation', TextType::class);

        $builder->add('numPolice', TextType::class);

        $builder->add('valableDu', DateType::class, array('widget' => 'single_text', 'format' => "d-M-y"));

        $builder->add('valableAu', DateType::class, array('widget' => 'single_text', 'format' => "d-M-y"));

        $builder->add('agBurCourt', TextType::class);



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
