<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use FloBen\AnatomEasyBundle\Entity\User;
use FloBen\AnatomEasyBundle\Entity\Group;


/**
 * Teacher controller. 
 *
 * @Route("/teacher")
 */
class TeacherController extends Controller
{
    /**
     * @Route("/", name="anatomeasy_teacher_index")
     * @Template()
     */
    public function indexAction()
    {
        // On teste que l'utilisateur dispose bien du rôle ROLE_TEACHER
        if( ! $this->get('security.context')->isGranted('ROLE_TEACHER') )
        {
            // Sinon on déclenche une exception "Accès Interdit"
            throw new AccessDeniedHttpException('Accès limité aux enseignants');
        }
        
        
        
        $currentTeacher = $this->container->get('security.context')->getToken()->getUser(); 
        $test=$currentTeacher->getEmail();
        
        //groupes de l'enseignant
        $group = new Group; 
        $formClasse = $this->createFormBuilder($group) 
                 ->add('name', 'text',array(
                                'label' => ' ',
                                'attr' => array('placeholder' => "Créer une classe")))
                 ->add('level', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Level',
                    'label' => ' ',
                    'attr' => array('class' => 'span1')))
                 ->getForm();
        
                     
        $student = new User();
         
        $formStudent = $this->createFormBuilder($student) 
                 ->add('username', 'text',array(
                                'label' => ' ',
                                'attr' => array('placeholder' => "Nom d'utilisateur",
                                                'class'       => 'span2')))
                 ->add('password', 'password', array( 
                    'label' => ' ',
                    'attr' => array('class'       => 'span2',
                                    'placeholder' => "mot de passe")))
                 ->add('group', 'entity', array(  
                    'class' => 'FloBenAnatomEasyBundle:Group' ))
                 ->getForm();  
           
        $em = $this->getDoctrine()->getManager();
        
        //ajout
        $request = $this->get('request'); 
        // On vérifie qu'elle est de type POST 
        if ($request->getMethod() == 'POST') {
            $formStudent->bind($request); 
            if ($formStudent->isValid()) {
                $student->setEmail(rand (0,9999999999999999))
                        ->addRole('ROLE_STUDENT') ;
                $em->persist($student);
                $em->flush();
            } else{ 
                $formClasse->bind($request);
                if ($formClasse->isValid()) {
                    $group->setTeacher( $currentTeacher ); 
                    $em->persist($group);
                    $em->flush(); 
                }else $test="prout"; 
            }
        }
        
        //classes de l'enseignant
        $entity = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->findByTeacher($currentTeacher->getId());
        return array(  
            'formClasse' => $formClasse->createView(),
            'formStudent' => $formStudent->createView(),
            'classes'    => $entity, 
            'test'       => $test
        ); 
    } 
}
 
