<?php

namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PhotoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('url', FileType::class,array(
            'multiple' => true
            ));
        $builder->add('accident');
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
                [
                    'data_class' => 'AssureurBundle\Entity\Photo',
                    'csrf_protection' => false
                ]
        );
    }

    public function getName() {
        return 'Photo';
    }

}
