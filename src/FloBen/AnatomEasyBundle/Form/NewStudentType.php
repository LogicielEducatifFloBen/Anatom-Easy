<?php

namespace FloBen\AnatomEasyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder  
            ->add('username', 'text',array(
                                'label' => ' ',
                                'attr' => array('placeholder' => "Nom d'utilisateur",
                                                'class'       => 'span2')))
            ->add('password', 'password', array( 
                'label' => ' ',
                'attr' => array('class'       => 'span2',
                                'placeholder' => "mot de passe"))) 
            ->add('group', 'entity',array(  
                'label' => ' ',
                'class' => 'FloBenAnatomEasyBundle:Group',
                'attr' => array( 'style'       => 'display:none;') ) )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBen\AnatomEasyBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'floben_anatomeasybundle_usertype';
    }
}
