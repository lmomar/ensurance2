<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AssureurBundle\Entity\Vehicule;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use AssureurBundle\Form\Type\VehiculeType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
class VehiculeController extends Controller {

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\VehiculeType",
     *  output="AssureurBundle\Entity\Vehicule"
     * )
     * @Rest\View()
     * @Rest\Post("/api/vehicule/add")
     */
    public function postVehiculeAction(Request $request) {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->submit($request->request->get($form->getName()));
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();
            return $vehicule;
        }
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Edit Object",
     *  input="AssureurBundle\Form\Type\VehiculeType",
     *  output="AssureurBundle\Entity\Vehicule",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Vehicule ID"
     *      }
     *  }
     * )
     * @Rest\View()
     * @Rest\Put("api/vehicule/edit/{id}")
     * @param Request $request
     */
    public function putVehiculeAction(Request $request) {
        $id = $request->request->get('id');

        $vehicule = $this->getDoctrine()->getRepository('AssureurBundle:Vehicule')->find($id);

        if (empty($vehicule)) {
            return new JsonResponse(['message' => 'Vehicule introuvable'], Response::HTTP_NOT_FOUND);
        }
        
        
        $form = $this->createForm(VehiculeType::class, $vehicule);
        
        $form->submit($request->request->get($form->getName()));
        //return $vehicule;
        if ($form->isSubmitted()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $vehicule;
        }
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Get Vehicule(s) By Id or UserID"
     * )
     * @Rest\View()
     * @Rest\Get("api/vehicules",name="getVehicules")
     * @param Request $request
     * @return JsonResponse
     * @QueryParam(name="id", requirements="\d+", default="", description="id vehicule")
     * @QueryParam(name="user_id", requirements="\d+", default="", description="user_id")
     */
    public function getVehiculeAction(Request $request, ParamFetcher $paramFetcher) {
        $id = $paramFetcher->get('id');
        $user_id = $paramFetcher->get('user_id');
        $filter = [];
        if (isset($id) && !empty($id)) {
            $filter['id'] = $id;
        }
        if (isset($user_id) && !empty($user_id)) {
            $filter['userId'] = $user_id;
        }
        return $this->getDoctrine()->getRepository('AssureurBundle:Vehicule')->findBy($filter);
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Delete Vehicule"
     * )
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("api/vehicule/delete/{id}")
     * @param Request $request
     */
    public function removeVehiculeAction(Request $request) {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $vehicule = $this->getDoctrine()->getRepository('AssureurBundle:Vehicule')->find($id);
        if (empty($vehicule)) {
            return new JsonResponse(['message' => 'Vehicule introuvable'], Response::HTTP_NOT_FOUND);
        }
        $vehicule->setDeleted(true);
        $em->flush(); 
        return new JsonResponse(['message' => 'Vehicule supprimé .'],200);
    }

}
