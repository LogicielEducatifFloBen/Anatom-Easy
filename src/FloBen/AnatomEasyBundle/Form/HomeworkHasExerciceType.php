<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomeworkHasExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('exercice', new ExerciceType(), array(  
                                                  'label' => ' ', 
                                                  ))
                    
                
        ;
    } 
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice' 
        ));
    }

    public function getName()
    {
        return 'floben_anatomeasybundle_homeworkhasexercicetype';
    }
}
