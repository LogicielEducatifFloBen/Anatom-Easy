<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template; 
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use FloBen\AnatomEasyBundle\Entity\User;
use FloBen\AnatomEasyBundle\Entity\Group;  
use FloBen\AnatomEasyBundle\Entity\Homework;  
use FloBen\AnatomEasyBundle\Entity\HomeworkHasExercice;  
use FloBen\AnatomEasyBundle\Form\NewStudentType; 
use FloBen\AnatomEasyBundle\Form\GroupNewStudentType; 
use FloBen\AnatomEasyBundle\Form\Type\RegistrationFormType; 
use FloBen\AnatomEasyBundle\Form\HomeworkType; 
use FloBen\AnatomEasyBundle\Form\ClasseType; 


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
        
        //formulaire nouvel éleve
        $studentForms = array();
        $studentFormsViews = array();
        $pupils = array();
        foreach ($groups as $index => $groupTmp) {
            $pupil= new User();  
            $pupil->setGroup($groupTmp)
                  ->setEmail(rand (0,9999999999999999))
                  ->addRole('ROLE_STUDENT') ; 
            
            $pupils []  = $pupil;  
            $studentForms []  = $this->createForm(new NewStudentType(), $pupil);  
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
                }else{
                            $tmp=$studentForms[0];
                            $tmp->bind($request);  
                        if ($tmp->isValid()) { 
                            foreach($pupils as $index => $pupil){//on stocke uniquement l'éleve dont le form a été remplie
                                if($pupil->getUsername()!=""){
                                    $pwd=$pupil->getPassword()."{". $pupil->getSalt()."}" ;
                                    $pupil->setPassword($pwd);
                                    $pupil->setEnabled(true);
                                    $em->persist($pupil);
                                    $em->flush(); 
                                 }
                             }
                        } 
                }
            return $this->redirect($this->generateUrl('anatomeasy_teacher_index'));
        }
        return array(  
            'formClasse'  => $formClasse->createView(), 
            'classeForms' => $studentFormsViews , 
            'classes'     => $groups, 
            'test'        => $test
        );  
    } 
    
    
    /**
     * @Route("/classe/{idGroup}", name="anatomeasy_teacher_group")
     * @Template()
     */
    public function groupAction($idGroup)
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
        $group = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->find($idGroup);
        $test=$currentTeacher->getEmail();//test, output var
        if($group->getTeacher()!==$currentTeacher){
            throw new AccessDeniedHttpException('Ce n\'est pas votre classe');
        }
        
        
        $classForm=$this->createForm(new ClasseType, $group);
        
        $homework = new Homework();
        $homeworkForm=$this->createForm(new HomeworkType, $homework); 
        

        //ajout dans la bdd
        $request = $this->get('request'); 
        // On vérifie qu'elle est de type POST 
        if ($request->getMethod() == 'POST') {
             
            $homeworkForm->bind($request);
            if ($homeworkForm->isValid()) { 
                
                foreach ($group->getStudent() as $student) {
                    $homeworkTmp = new Homework($homework);
                    $homeworkTmp->setDeadline($homework->getDeadline());
                    $homeworkTmp->setStudent($student);
                    $em->persist($homeworkTmp);
                    
                    foreach ($homework->getHomeworkHasExercice() as $homeworkHasExercice) {
                    // permet la suppression dans la bdd de homeworkHasExercice  
                        $homeworkHasExerciceTmp = new HomeworkHasExercice($homeworkHasExercice);
                        $homeworkHasExerciceTmp->setExercice($homeworkHasExercice->getExercice());
                        $homeworkHasExerciceTmp->setHomework($homeworkTmp);
                        
                        
                        $em->persist($homeworkHasExerciceTmp);
                    } 
                }
                    $em->flush();  
            }
        }
    
        return array(   
            'classe'      => $group,
            'classeForm'  => $classForm->createView(),
            'devoirForm'  => $homeworkForm->createView(),
            'test'        => $test
        );
    }
    
    
    
    /**
     * @Route("/classe/{idGroup}/nouveau_devoir", name="anatomeasy_teacher_group_new_homework") 
     */
    public function addHomeworkToGroupAction($idGroup)
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
        $group = $em->getRepository('FloBenAnatomEasyBundle:Group')
                     ->find($idGroup);
        $test=$currentTeacher->getEmail();//test, output var
        if($group->getTeacher()!==$currentTeacher){
            throw new AccessDeniedHttpException('Ce n\'est pas votre classe');
        }
        
        $homework = new Homework();
        $homeworkForm=$this->createForm(new HomeworkType, $homework); 
        
        //ajout dans la bdd
        $request = $this->get('request'); 
        // On vérifie qu'elle est de type POST 
        if ($request->getMethod() == 'POST') {
             
                $homeworkForm->bind($request);
                if ($homeworkForm->isValid()) { 
                    
                    foreach ($group->getStudent() as $student) {
                        $homeworkTmp = new Homework($homework);
                        $homeworkTmp->setDeadline($homework->getDeadline());
                        $homeworkTmp->setStudent($student);
                        $em->persist($homeworkTmp);
                        
                        foreach ($homework->getHomeworkHasExercice() as $homeworkHasExercice) {
                        
                            $homeworkHasExerciceTmp = new HomeworkHasExercice($homeworkHasExercice);
                            $homeworkHasExerciceTmp->setExercice($homeworkHasExercice->getExercice())
                                                   ->setHomework($homeworkTmp); 
                            $em->persist($homeworkHasExerciceTmp);
                        } 
                    }
                        $em->flush();  
                }
        }
        return $this->redirect($this->generateUrl('anatomeasy_teacher_group', array('idGroup'=>$idGroup))); 
    }
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
