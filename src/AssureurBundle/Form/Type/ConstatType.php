<?php
namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConstatType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder,array $options) {
        $builder->add('type', \Symfony\Component\Form\Extension\Core\Type\TextType::class);
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

