<?php
namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ConstatType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder,array $options) {
        $builder
            ->add('venantDe')
            ->add('allantVers')
            ->add('pointChoc',FileType::class,array('mapped' => false))
            ->add('descDegat')
            ->add('c1')
            ->add('c2')
            ->add('c3')
            ->add('c4')
            ->add('c5')
            ->add('c6')
            ->add('c7')
            ->add('c8')
            ->add('c9')
            ->add('c10')
            ->add('c11')
            ->add('c12')
            ->add('c13')
            ->add('c14')
            ->add('observations')
            ->add('nomConducteur')
            ->add('prenomConducteur')
            ->add('adresseConducteur')
            ->add('signature',FileType::class,array('mapped' => false))
            ->add('accident');


    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'AssureurBundle\Entity\Constat'
        ]);
    }
    
    public function getName() {
        return 'Constat';
    }
}


