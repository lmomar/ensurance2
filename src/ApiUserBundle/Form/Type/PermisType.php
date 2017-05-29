<?php
namespace ApiUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class PermisType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('categorie', TextType::class)
                ->add('dateDelivre', DateTimeType::class,array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'd-M-y'
                ))
                ->add('prefecture', TextType::class)
                ->add('user');
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'ApiUserBundle\Entity\Permis',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'em' => false
        ]);
    }
    
    public function getName() {
        return 'permis';
    }
}

