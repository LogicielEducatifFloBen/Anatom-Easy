<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Index controller.
 *
 * @Route("/index")
 */
class IndexController extends Controller
{
    /**
     * @Route("", name="anatomeasy_index_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}

