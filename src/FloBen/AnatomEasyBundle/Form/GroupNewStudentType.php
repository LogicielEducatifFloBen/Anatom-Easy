<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupNewStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('student', 'collection', array('type'         => new NewStudentType(),
                                                  'allow_add'    => true, 
                                                  'by_reference' => false)) 
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
