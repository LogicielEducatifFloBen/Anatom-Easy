<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FloBen\AnatomEasyBundle\Repository\LevelRepository;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('level', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Level',
                    'label' => ' ',
                    'attr' => array('class' => 'span1',
                                    'style' => 'float:left' )))
            ->add('type', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Type',
                    'label' => ' ',
                    'attr' => array('class' => 'span2',
                                    'style' => 'float:left;')))
            ->add('subjects', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Subjects',
                    'label' => ' ',
                    'attr' => array('class' => 'span2',
                                    'style' => 'float:left;')))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBen\AnatomEasyBundle\Entity\Exercice', 
        ));
    }

    public function getName()
    {
        return 'floben_anatomeasybundle_exercicetype';
    }
}
