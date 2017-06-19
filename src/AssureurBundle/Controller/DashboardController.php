<?php

namespace AssureurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{

    /**
     * @Route("/dashboard",name="dashboard")
     * @return type
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $usersCount = $em->getRepository('ApiUserBundle:User')->count();
        $accidentsCount = $em->getRepository('AssureurBundle:Accident')->count();
        $dossiersCount = $em->getRepository('AssureurBundle:Dossier')->count();
        return $this->render("AssureurBundle:dashboard:index.html.twig",
            array('usersCount' => $usersCount,'accidentsCount' => $accidentsCount,'dossiersCount' => $dossiersCount));
    }
}

