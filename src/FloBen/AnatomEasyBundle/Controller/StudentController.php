<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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

}

