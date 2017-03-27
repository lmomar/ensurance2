<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use AssureurBundle\Entity\Constat;
use AssureurBundle\Form\Type\ConstatType;

class ConstatController extends Controller{

    /**
     * @Rest\View
     * @Rest\Post("api/constat/add")
     * @param Request $request
     * @return Constat
     */
    public function postConstatAction(Request $request) {
        $constat = new Constat();
        $form = $this->createForm(ConstatType::class,$constat);
        $form->submit($request->request->all());
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($constat);
            $em->flush();
            return $constat;
        }
    }
}