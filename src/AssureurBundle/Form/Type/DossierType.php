<?php
namespace AssureurBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DossierType extends AbstractType{
    
    public function buidForm(FormBuilderInterface $builder, array $options) {
        $builder->add('date_ouverture');
        $builder->add('date_fermeture');
        $builder->add('statut', TextType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
                [
                    'data_class' => 'AssureurBundle\Entity\Dossier',
                    'csrf_protection' => false,
                    'allow_extra_fields' => true
                ]
                );
    }
    
    public function getName() {
        return 'Dossier';
    }
}

