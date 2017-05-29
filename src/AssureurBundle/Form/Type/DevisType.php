<?php

namespace AssureurBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url',FileType::class);
        $builder->add('dossier');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AssureurBundle\Entity\Devis',
                'csrf_protection' => false,
                'allow_extra_fields' => true,
                'em' => false
            ]
        );
    }

    public function getName()
    {
        return 'devis';
    }
}
