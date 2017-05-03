<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use AssureurBundle\Entity\Accident;
use AssureurBundle\Form\Type\AccidentType;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AccidentController extends Controller{
    /**
     * @ApiDoc(
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\AccidentType",
     *  output="AssureurBundle\Entity\Accident"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/accident/add")
     * @return Accident
     */
    public function postAccidentAction(Request $request) {
        $accident = new Accident();
        $form = $this->createForm(AccidentType::class,$accident);
        $form->submit($request->request->all());
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($accident);
            $em->flush();
            return $accident;
        }
        else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  description="Edit Object",
     *  input="AssureurBundle\Form\Type\AccidentType",
     *  output="AssureurBundle\Entity\Accident",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="return one Object"
     *      }
     *  }
     * )
     * @param Request $request
     * @param $id
     * @return null|object|\Symfony\Component\Form\FormErrorIterator|JsonResponse
     * @Rest\View
     * @Rest\Put("/api/accident/edit/{id}")
     */
    public function putAccidentAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $accident = $em->getRepository('AssureurBundle:Accident')->find($id);
        if(empty($accident)){
            return new JsonResponse('not found',404);
        }
        $form = $this->createForm(AccidentType::class,$accident);
        $form->submit($request->request->all());
        if($form->isSubmitted())
        {
            $em->flush();
            return $accident;
        }
        else{
            return $form->getErrors();
        }
    }
    /**
    * @Rest\View
    * @Rest\Delete("/api/accident/delete/{id}")
    */

    public function deleteAccidentAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $accident = $em->getRepository("AssureurBundle:Accident")->find($id);
        if(empty($accident))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $accident->setDeleted(true);
        $em->flush();
        return new JsonResponse(['message' => 'Accident supprimé']);
    }

    /**
    * @Rest\View
    * @Rest\Get("/api/accident/{id}")
    */
    public function getAccidentAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $accident = $em->getRepository("AssureurBundle:Accident")->find($id);
        if(empty($accident)){
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $accident;
    }

    /**
    * @Rest\View
    * @Rest\Get("/api/accident/vehicule/{id}")
    */
    public function getAccidentByVehiculeIdAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AssureurBundle:Accident')->findBy(array('vehiculeId' => $id));
        return $liste;
    }
}


