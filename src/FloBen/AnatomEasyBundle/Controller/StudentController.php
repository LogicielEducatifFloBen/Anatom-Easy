<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
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
        return array(); 
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

