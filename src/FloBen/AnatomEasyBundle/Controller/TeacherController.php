<?php

namespace FloBen\AnatomEasyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use FloBen\AnatomEasyBundle\Entity\Teacher;
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
        // On teste que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if( ! $this->get('security.context')->isGranted('ROLE_TEACHER') )
        {
            // Sinon on déclenche une exception "Accès Interdit"
            throw new AccessDeniedHttpException('Accès limité aux enseignants');
        }
        
        
        
        $currentTeacher = $this->container->get('security.context')->getToken()->getUser();
        
          $group = new Group;
  
    $form = $this->createFormBuilder($group) 
                 ->add('name', 'text') 
                 ->add('Level', 'entity', array(
                    'class' => 'FloBenAnatomEasyBundle:Level'))
                 ->getForm();
 
    // On récupère la requête
    $request = $this->get('request');
 
    // On vérifie qu'elle est de type POST
    if ($request->getMethod() == 'POST') {
      // On fait le lien Requête <-> Formulaire
      $form->bind($request);
 
      // On vérifie que les valeurs rentrées sont correctes
      // (Nous verrons la validation des objets en détail plus bas dans ce chapitre)
      if ($form->isValid()) { 
      
        $em = $this->getDoctrine()->getManager();
        //$group->setTeacher($currentTeacher);
        $em->persist($group);
        $em->flush(); 
      }
    }
    

         

        return array(  
           'form' => $form->createView(),
           'test' => $currentTeacher->getEmail()
        ); 
    }
    
    
}
/*

    /**
     * Creates a new Event entity.
     *
     * @Route("/create", name="admin_schedule_event_create")
     * @Method("POST")
     * @Template("IDCISimpleScheduleBundle:Event:new.html.twig")
     */
     /*
    public function createAction(Request $request)
    {
        $entity  = new Event();
        $form = $this->createForm(new EventType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Event',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_schedule_event_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
        */
