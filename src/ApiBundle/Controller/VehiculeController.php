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

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use FOS\RestBundle\Serializer\Serializer;
class VehiculeController extends Controller {

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\VehiculeType",
     *  output="AssureurBundle\Entity\Vehicule"
     * )
     * @Rest\View()
     * @Rest\Post("/vehicule/add")
     */
    public function postVehiculeAction(Request $request) {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->submit($request->request->get($form->getName()));
        if ($form->isSubmitted()) {
            $userID = $request->request->get($form->getName())['user'];
            $userManager = $this->get('fos_user.user_manager');
            $user  = $userManager->findUserBy(array('id' => $userID));
            if(empty($user))
            {
                return new JsonResponse(['message' => 'user not found'],404);
            }
            $em = $this->getDoctrine()->getManager();
            $vehicule->setUser($user);
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
     * @Rest\Put("/vehicule/edit/{id}")
     * @param Request $request
     */
    public function putVehiculeAction(Request $request,$id) {
        $vehicule = $this->getDoctrine()->getRepository('AssureurBundle:Vehicule')->findOneBy(array(
            'deleted' => false,'id' => $id
        ));
        if (empty($vehicule)) {
            return new JsonResponse(['message' => 'Vehicule introuvable'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->submit($request->request->get($form->getName()));
        //return $vehicule;
        if ($form->isSubmitted()) {
            $userID = $request->request->get($form->getName())['user'];
            $userManager = $this->get('fos_user.user_manager');
            $user  = $userManager->findUserBy(array('id' => $userID));
            if(empty($user))
            {
                return new JsonResponse(['message' => 'user not found'],404);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $vehicule;
        }
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Get Vehicule By Id "
     * )
     * @Rest\View()
     * @Rest\Get("/vehicule/{id}",name="getVehicule")
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function getVehiculeByIdAction(Request $request, $id) {
        $data= $this->getDoctrine()->getRepository('AssureurBundle:Vehicule')->findBy(array('deleted' => false,'id' => $id));
        if(empty($data))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $data;
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Get Vehicule(s) By UserID"
     * )
     * @Rest\View()
     * @Rest\Get("/vehicules/user/{user_id}",name="getVehicules")
     * @param Request $request
     * @param integer $user_id
     * @return JsonResponse
     */
    public function getVehiculeByUserIdAction(Request $request, $user_id) {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $user_id));
        return $user->getVehicules();
    }

    /**
     * @ApiDoc(
     *  section="Vehicule",
     *  description="Delete Vehicule"
     * )
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/vehicule/delete/{id}")
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
