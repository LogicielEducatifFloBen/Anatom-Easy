<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        return array();
    }
}

