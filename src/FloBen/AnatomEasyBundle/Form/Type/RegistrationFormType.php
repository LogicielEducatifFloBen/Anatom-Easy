<?php

namespace FloBen\AnatomEasyBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder  
            /*->add('username', 'text',array(
                                'label' => ' ',
                                'attr' => array('placeholder' => "Nom d'utilisateur",
                                                'class'       => 'span2')))
            ->add('password', 'password', array( 
                'label' => ' ',
                'attr' => array('class'       => 'span2',
                                'placeholder' => "mot de passe"))) */
            ->add('roles', 'choice', array(
                    'choices'   => array( 'ROLE_STUDENT'   => 'Elève', 'ROLE_TEACHER' => 'Professeur' ),
                    'multiple'  => true,
                    'expanded'  => true, 
                ))
            ->remove('email')
            ->add('email','hidden',array(
                'data' => ''.rand (0,9999999999999999).'@'.rand (0,9999999999999999).'.fr',
            )) 
            ; 
    }

    public function getName()
    {
        return 'anatomeasybundle_user_registration';
    }
}
