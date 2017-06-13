<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 08/06/2017
 * Time: 09:37
 */

namespace AssureurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
class AccidentController extends Controller
{
    /**
     * @Route("/admin/accidents",name="accidents_list")
     */
    public function index(){
        $em= $this->getDoctrine()->getManager();
        $accidents = $em->getRepository('AssureurBundle:Accident')->findBy(array('deleted' => false));

        return $this->render("AssureurBundle:accident:index.html.twig",array('accidents' => $accidents));
    }
}
