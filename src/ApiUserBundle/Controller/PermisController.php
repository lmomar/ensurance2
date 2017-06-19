<?php

namespace ApiUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use ApiUserBundle\Entity\Permis;
use ApiUserBundle\Form\Type\PermisType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
class PermisController extends Controller{
    
    /**
     * @ApiDoc(
     *  section="Permis",
     *  description="Create a new Object",
     *  input="ApiUserBundle\Form\Type\PermisType",
     *  output="ApiUserBundle\Entity\Permis"
     * )
     * @Rest\View()
     * @Rest\Post("/permis/add")
     */
    public function postPermisAction(Request $request) {
        $permis = new Permis();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PermisType::class,$permis);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $userID = $request->request->get($form->getName())['user'];
            $userManager = $this->get('fos_user.user_manager');
            $user  = $userManager->findUserBy(array('id' => $userID));
            if(empty($user))
            {
                return new JsonResponse(['message' => 'user not found'],404);
            }
            $permis->setUser($user);
            $em->persist($permis);
            $em->flush();
            return $permis;
        }
        
    }
    
   /**
     * @ApiDoc(
     *  section="Permis",
     *  description="Get Permis By User ID",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="User ID"
     *      }
     *  }
     * )
     * @Rest\View()
     * @Rest\Get("/permis/get/{id}",name="getPermisByUserId")
     */
    public function getPermisAction(Request $request) {
        //return $request->get('id');
        $id = $request->get('id');
        
        $rep = $this->getDoctrine()->getManager()->getRepository("ApiUserBundle:Permis");
        $permis = $rep->findBy(array('user' => $id,'deleted' => false));
        if(empty($permis)){
            return new JsonResponse(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }
        return $permis;
    }
    
    /**
     * @ApiDoc(
     *  section="Permis",
     *  description="Edit Object",
     *  input="ApiUserBundle\Form\Type\PermisType",
     *  output="ApiUserBundle\Entity\Permis",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Permis ID"
     *      }
     *  }
     * )
     * @Rest\View()
     * @Rest\Put("/permis/edit/{id}")
     */
    public function putPermisAction(Request $request,$id) {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository("ApiUserBundle:Permis");
        $permis = $rep->findOneBy(array('id' => $id,'deleted' => false));
        if(empty($permis)){
            return new JsonResponse(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(PermisType::class,$permis);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $permis->setDateDelivre(new \DateTime($request->request->get('dateDelivre')));
            $em->persist($permis);
            $em->flush();
            return $permis;
        }
        
    }
}

