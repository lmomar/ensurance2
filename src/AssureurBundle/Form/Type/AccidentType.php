<?php
namespace AssureurBundle\Form\Type;

use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AccidentType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('coord1')
            ->add('coord2')
            ->add('dateAccident',DateTimeType::class,array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'd-M-y'
            ))
            ->add('rue')
            ->add('ville')
            ->add('pays')
            ->add('blesses',CheckboxType::class)
            ->add('degatAutre',CheckboxType::class)
            ->add('croquisUrl',FileType::class,array('multiple' => false))
            ->add('vehiculeId');
    }

    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
                [
                    'data_class' => 'AssureurBundle\Entity\Accident',
                    'csrf_protection' => false,
                    'allow_extra_fields' => true,
                    'em' => false
                ]
                );
    }
    
    public function getName() {
        return 'accident';
    }
}

