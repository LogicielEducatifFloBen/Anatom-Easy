<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Index controller.
 *
 * @Route("/")
 */
class IndexController extends Controller
{
    /**
     * @Route("", name="anatomeasy_index_index")
     * @Template()
     */
    public function indexAction()
    { 
        if(  $this->get('security.context')->isGranted('ROLE_TEACHER') )
        {
            return $this->redirect($this->generateUrl('anatomeasy_teacher_index')); 
        }elseif(  $this->get('security.context')->isGranted('ROLE_STUDENT') )
        {
            return $this->redirect($this->generateUrl('anatomeasy_student_index')); 
        }
        return array();
    }
}

