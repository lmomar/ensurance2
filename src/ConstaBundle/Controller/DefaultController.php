<?php

namespace ConstaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/consta", name="home_consta")
     */
    public function indexAction()
    {
        return $this->render('ConstaBundle:Default:index.html.twig');
    }
}
