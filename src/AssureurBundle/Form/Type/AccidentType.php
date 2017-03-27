<?php
namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class AccidentType extends AbstractType{
    
    public function buidForm(FormBuilderInterface $builder, array $options) {
        $builder->add('coord1');
        $builder->add('coord2');
        $builder->add('description', TextType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
                [
                    'data_class' => 'AssureurBundle\Entity\Accident'
                ]
                );
    }
    
    public function getName() {
        return 'Accident';
    }
}

