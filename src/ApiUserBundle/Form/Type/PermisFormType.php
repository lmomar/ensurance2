<?php
namespace ApiUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class PermisFormType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('categorie', TextType::class)
                ->add('date_delivre', DateType::class,array(
                    'widget' => 'single_text'
                ))
                ->add('prefecture', TextType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'ApiUserBundle\Entity\Permis'
        ]);
    }
    
    public function getName() {
        return 'Permis';
    }
}

