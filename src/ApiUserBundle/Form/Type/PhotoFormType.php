<?php

namespace AssureurBundle\Form\Type;


use Symfony\Component\Form\AbstractType;


class PhotoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('url', FileType::class, array(
            'multiple' => true
        ));

        $builder->add('constat_id', TextType::class);


    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(
            [
                'data_class' => 'AssureurBundle\Entity\Photo',
                'csrf_protection' => false
            ]
        );

    }

    public function getName()
    {

        return 'Photo';

    }

}


