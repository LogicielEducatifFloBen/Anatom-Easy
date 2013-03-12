<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
 
use FloBen\AnatomEasyBundle\Entity\Result;  
use FloBen\AnatomEasyBundle\Entity\Sandbox;  
use FloBen\AnatomEasyBundle\Entity\Exercice;  
/**
 * Student controller.
 *
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * @Route("/", name="anatomeasy_student_index")
     * @Template()
     */
    public function indexAction()
    {
        // On teste que l'utilisateur dispose bien du rôle ROLE_STUDENT
        if( ! $this->get('security.context')->isGranted('ROLE_STUDENT') )
        {
            // Sinon on déclenche une exception "Accès Interdit"
            throw new AccessDeniedHttpException('Accès limité aux élèves');
        }
        $em = $this->getDoctrine()->getManager();
        
        
        
        //on récupere les entités
        $currentStudent = $this->container->get('security.context')->getToken()->getUser();
        $group = $currentStudent->getGroup();  
        
        return array('group'=>$group); 
    }  
	
	 /**
     * @Route("/cours/{id}", name="anatomeasy_student_niveaux")
     * @Template()
     */
    public function niveauxAction($id)
    {
        return array('idCours' => $id);
    }
	
	/**
     * @Route("/cours/{idCours}/{idNiveau}", name="anatomeasy_student_cours")
	 * @Template()
     */
    public function coursAction($idCours,$idNiveau)
    {
		return array('idCours' =>$idCours,'idNiveau' =>$idNiveau);
    }
	
	/**
     * @Route("/exercices/{idExercice}/{idTheme}/{idNiveau}", name="anatomeasy_student_exercices")
	 * @Template()
     */
    public function exercicesAction($idExercice,$idTheme,$idNiveau)
    {
        if($idTheme=="Les_cinq_sens")$idTheme="Les_sens";
		return array('idExercice' =>$idExercice,'idTheme' =>$idTheme, 'idNiveau' =>$idNiveau);
    }
	
	
	/**
     *   test si l'exercice était un devoir non fait
     *   ajoute le resultat
     * @Route("/exercices/{idExercice}/{idTheme}/{idNiveau}/register", name="anatomeasy_student_exercices_register_result")
	 * @Method({"POST"})
     */
    public function registerResultAction(Request $request,$idExercice,$idTheme,$idNiveau)
    {
    
        // On teste que l'utilisateur dispose bien du rôle ROLE_STUDENT
        if( ! $this->get('security.context')->isGranted('ROLE_STUDENT') )
        {
            // Sinon on déclenche une exception "Accès Interdit"
            throw new AccessDeniedHttpException('Accès limité aux élèves');
        }
        $em = $this->getDoctrine()->getManager();
        // $_POST parameters 
        $currentStudent = $this->container->get('security.context')->getToken()->getUser();  
        $idTheme = str_replace("_", " ", $idTheme);
        $test=''; 
        
        $result= new Result();
        $result->setDate(new \DateTime(date('Y-m-d H:i:s')));  
         
        $result->setSecondSpent(intval($request->request->get('secondSpent', '')));  
        $result->setScore(intval($request->request->get('score', ''))); 
        $result->setSuccess(($request->request->get('success', '')=="true")); 
        $em->persist($result);
        
        $hasHomework=false; 
        //cherche si l'exercice envoyé était un devoir
        foreach ($currentStudent ->getHomework() as $homework) {
            foreach ($homework ->getHomeworkHasExercice() as $homeworkHasExercice) {
                $exercice=$homeworkHasExercice->getExercice(); 
                if(($exercice->getLevel()==$idNiveau) &&
                   ( (strcmp($exercice->getSubjects(), $idTheme)==0))  && 
                   ($exercice->getType()==$idExercice)){
                    //creer result et check si done ok
                    if(!$homeworkHasExercice->getDone()){
                    
                        $hasHomework=true;  
                        
                        $homeworkHasExercice->setDone(true) ;
                        $homeworkHasExercice->setResult( $result);
                        
                        $em->persist($homeworkHasExercice);
                    }
                }
            }
        }
        //si pas de de voir, l'exercice est sauvegardé en sandbox
        if(!$hasHomework){
            $exercice= new Exercice();
            $exercice->setLevel($em->getRepository('FloBenAnatomEasyBundle:Level')->find($idNiveau));
            $exercice->setSubjects($em->getRepository('FloBenAnatomEasyBundle:Subjects')->find($idTheme));
            $exercice->setType($em->getRepository('FloBenAnatomEasyBundle:Type')->find($idExercice));
            $em->persist($exercice);
            
            $sandbox= new Sandbox();
            $sandbox->setExercice($exercice) ;
            $sandbox->setStudent($currentStudent) ;
            $sandbox->setResult( $result);
            $em->persist($sandbox);
        }
        $em->flush(); 
        $response = new Response();  
        $response->setStatusCode(200);  
        return $response;
    }
	
	/**
     * @Route("/recreation/{idMedia}", name="anatomeasy_student_recreation")
	 * @Template()
     */
    public function recreationAction($idMedia)
    {
		return array('idMedia' =>$idMedia);
    }
    
    
	 
    

}

