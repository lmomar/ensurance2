<?php

namespace ApiUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;


use ApiUserBundle\Entity\Permis;
use ApiUserBundle\Form\Type\PermisFormType;

class PermisController extends Controller{
    
    /**
     * @Rest\View()
     * @Rest\Post("/api/permis/add")
     */
    public function postPermisAction(Request $request) {
        $permis = new Permis();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PermisFormType::class,$permis);
        $form->submit($request->request->all());
        if($form->isSubmitted())
        {
            $permis->setDateDelivre(new \DateTime($request->request->get('dateDelivre')));
            $permis->setUserId("1");
            $em->persist($permis);
            $em->flush();
            return $permis;
        }
        
    }
    
    /**
     * @Rest\View()
     * @Rest\Get("/api/permis/get/{id}",name="getPermisByUserId")
     */
    public function getPermisAction(Request $request) {
        //return $request->get('id');
        $id = $request->get('id');
        
        $rep = $this->getDoctrine()->getManager()->getRepository("ApiUserBundle:Permis");
        $permis = $rep->findBy(array('userId' => $id));
        if(empty($permis)){
            return new JsonResponse(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }
        return $permis;
    }
    /**
     * @Rest\View()
     * @Rest\Put("/api/permis/edit/{id}")
     */
    public function putPermisAction(Request $request) {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository("ApiUserBundle:Permis");
        $permis = $rep->find($id);
        if(empty($permis)){
            return new JsonResponse(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(PermisFormType::class,$permis);
        $form->submit($request->request->all());
        if($form->isSubmitted())
        {
            $permis->setDateDelivre(new \DateTime($request->request->get('dateDelivre')));
            $em->persist($permis);
            $em->flush();
            return $permis;
        }
        
    }
}

