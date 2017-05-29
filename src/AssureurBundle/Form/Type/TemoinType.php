<?php

namespace AssureurBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class TemoinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom',TextType::class)
                ->add('prenom',TextType::class)
                ->add('tel',TextType::class)
                ->add('email',TextType::class)
                ->add('adresse',TextType::class)
                ->add('accident');
                
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AssureurBundle\Entity\Temoin',
                'csrf_protection' => false,
                'allow_extra_fields' => true,
                'em' => false
            ]
        );
    }

    public function getName()
    {
        return 'temoin';
    }
}
