<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/05/2017
 * Time: 09:50
 */

namespace AssureurBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateOuverture',DateType::class,array(
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'd-M-y'
        ));
        $builder->add('dateFermeture',DateType::class,array(
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'd-M-y',
            'required' => false
        ));
        $builder->add('statut');
        $builder->add('accident');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AssureurBundle\Entity\Dossier',
                'csrf_protection' => false,
                'allow_extra_fields' => true,
                'em' => false
            ]
        );
    }

    public function getName()
    {
        return 'dossier';
    }
}
