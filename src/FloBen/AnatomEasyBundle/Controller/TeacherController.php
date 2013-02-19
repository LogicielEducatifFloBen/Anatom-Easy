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
use FloBen\AnatomEasyBundle\Form\ExerciceType; 
use FloBen\AnatomEasyBundle\Form\UserType; 
use FloBen\AnatomEasyBundle\Form\GroupType; 


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
        $em = $this->getDoctrine()->getManager();
        
        
        
        //on récupere les entités
        $currentTeacher = $this->container->get('security.context')->getToken()->getUser();
        $groups = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->findByTeacher($currentTeacher->getId());
        $test=$currentTeacher->getEmail();//test, output var
        
        
        
        
        //formulaire nouvelle classe
        $group = new Group; 
        $group->setTeacher( $currentTeacher ); 
        $formClasse = $this->createFormBuilder($group) 
                 ->add('name', 'text',array(
                                'label' => ' ',
                                'attr' => array('placeholder' => "Créer une classe")))
                 ->add('level', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Level',
                    'label' => ' ',
                    'attr' => array('class' => 'span1')))
                 ->getForm();
        
          
        $studentForms = array();
        $pupils = array();
        foreach ($groups as $index => $groupTmp) {
            $pupil= new User();  
            $pupil->setGroup($groupTmp)
                  ->setEmail(rand (0,9999999999999999))
                  ->addRole('ROLE_STUDENT') ; 
            
            $pupils []  = $pupil;  
            $studentForms []  = $this->createForm(new UserType, $pupil);  
            $studentFormsViews [ ] = $studentForms [$index]->createView(); 
        } 


        //ajout dans la bdd
        $request = $this->get('request'); 
        // On vérifie qu'elle est de type POST 
        if ($request->getMethod() == 'POST') {
             
                $formClasse->bind($request);
                if ($formClasse->isValid()) {//group
                    $em->persist($group);
                    $em->flush();
                    return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
                }else{ 
                            $tmp=$studentForms[0];
                            $tmp->bind($request);  
                        if ($tmp->isValid()) { 
                            foreach($pupils as $index => $pupil){//on stocke uniquement les eleves 
                                if($pupil->getUsername()!=""){
                                    $test.= $pupil->getUsername();
                                    $em->persist($pupil);
                                    $em->flush();
                                    return $this->redirect($this->generateUrl('anatomeasy_teacher_index')); 
                                 }
                             }
                        } 
                    
                }
                
                    /*}else{ 
                    $formHomework->bind($request);
                    if ($formHomework->isValid()) {
                        
                        foreach ($homework->getHomeworkHasExercice() as $homeworkHasExercice) { 
                    
                            // if it were a ManyToOne relationship, remove the relationship like this
                            // $tag->setHomeworkHasExercice(null);

                            $em->persist($homeworkHasExercice);

                            // if you wanted to delete the Tag entirely, you can also do that
                            // $em->remove($tag);
                        }
                        $em->persist($homework);
                        $em->flush(); 
                        //return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
                       
                    
                }
                     */ 
        }
        return array(  
            'formClasse'  => $formClasse->createView(), 
            'classeForms' => $studentFormsViews , 
            'classes'     => $groups, 
            'test'        => $test
        );  
    } 
    
    
    /**
     * @Route("/classe/{id}", name="anatomeasy_teacher_group")
     * @Template()
     */
    public function groupAction()
    {
        
        // On teste que l'utilisateur dispose bien du rôle ROLE_TEACHER
        if( ! $this->get('security.context')->isGranted('ROLE_TEACHER') )
        {
            // Sinon on déclenche une exception "Accès Interdit"
            throw new AccessDeniedHttpException('Accès limité aux enseignants');
        }
        $em = $this->getDoctrine()->getManager();
        
        
        
        //on récupere les entités
        $currentTeacher = $this->container->get('security.context')->getToken()->getUser();
        $groups = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->findByTeacher($currentTeacher->getId());
        $test=$currentTeacher->getEmail();//test, output var
        
    
        return array(   
            'test'        => $test
        );  
    }
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
