<?php

namespace Kendoctor\Bundle\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Kendoctor\Bundle\TestBundle\Entity\Paper;


class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $em =$this->getDoctrine()->getManager();
  
        
        return array('name' => $name);
    }
}
