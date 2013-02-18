<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use FloBen\AnatomEasyBundle\Entity\User;
use FloBen\AnatomEasyBundle\Entity\Group;
use FloBen\AnatomEasyBundle\Entity\Homework; 
use FloBen\AnatomEasyBundle\Form\HomeworkType; 
use FloBen\AnatomEasyBundle\Form\ExerciceType; 


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
        $test=$currentTeacher->getEmail();//test
        
        //formulaire nouvelle classe
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
        
        //formulaire nouvel élève
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
        
        //formulaire nouveau devoir
        $homework = new Homework;  
        $formHomework = $this->createForm(new HomeworkType, $homework);
        
        $em = $this->getDoctrine()->getManager();
        
        //classes de l'enseignant
        $groups = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->findByTeacher($currentTeacher->getId());
        
        //ajout dans la bdd eleve/classe
        $request = $this->get('request'); 
        // On vérifie qu'elle est de type POST 
        if ($request->getMethod() == 'POST') {
            $formStudent->bind($request); 
            if ($formStudent->isValid()) {
                $student->setEmail(rand (0,9999999999999999))
                        ->addRole('ROLE_STUDENT') ;
                $em->persist($student);
                $em->flush(); 
                //empeche de refaire un ajout en cas de rafraichissement
                return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
            } else{ 
                $formClasse->bind($request);
                if ($formClasse->isValid()) {
                    $group->setTeacher( $currentTeacher ); 
                    $em->persist($group);
                    $em->flush(); 
                    return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
                }else{ 
                    $formHomework->bind($request);
                    if ($formHomework->isValid()) {
                        $homework->setTeacher( $currentTeacher ); 
                        $em->persist($group);
                        $em->flush(); 
                        //return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
                    }else $test="prout";
                }
            }
        }
        return array(  
            'formClasse' => $formClasse->createView(),
            'formDevoir' => $formHomework->createView(),
            'formStudent' => $formStudent->createView(),
            'classes'    => $groups, 
            'test'       => $test
        ); 
    } 
}
 
