<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomeworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deadline', 'date',array(
                                    'widget' => 'single_text',
                                    'format' => 'yyyy-MM-dd'))
            ->add('homeworkHasExercice', 'collection', array('type'         => new HomeworkHasExerciceType(),
                                                  'allow_add'    => true,
                                                  'allow_delete' => true)) 
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBen\AnatomEasyBundle\Entity\Homework'
        ));
    }

    public function getName()
    {
        return 'floben_anatomeasybundle_homeworktype';
    }
}
