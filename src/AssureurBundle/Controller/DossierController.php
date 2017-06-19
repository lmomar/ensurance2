<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 08/06/2017
 * Time: 16:39
 */

namespace AssureurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DossierController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/dossiers",name="dossier_list")
     */
    public function index(){
        $em = $this->getDoctrine()->getManager()->getRepository('AssureurBundle:Dossier');
        $dossiers = $em->findAll();
        return $this->render('AssureurBundle:dossier:index.html.twig',array('dossiers' => $dossiers));
    }

}