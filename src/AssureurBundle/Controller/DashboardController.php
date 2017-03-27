<?php
namespace AssureurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DashboardController extends Controller{
    
    /**
     * @Route("/dashboard",name="dashboard")
     * @return type
     */
    public function index() {
        return $this->render("AssureurBundle:dashboard:index.html.twig");
    }
}

