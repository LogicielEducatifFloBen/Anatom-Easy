<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array('label'=>'Nom',
                                     'attr' =>array('class'=>'span2')))
            ->add('level',null,array('label'=>'Niveau',
                                     'attr' =>array('class'=>'span1'))) 
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBen\AnatomEasyBundle\Entity\Group'
        ));
    }

    public function getName()
    {
        return 'floben_anatomeasybundle_grouptype';
    }
}
