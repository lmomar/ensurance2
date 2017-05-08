<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;


use AssureurBundle\Entity\Temoin;
use AssureurBundle\Form\Type\TemoinType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TemoinController extends Controller{

    /**
     * @ApiDoc(
     *  section="Temoin",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\TemoinType",
     *  output="AssureurBundle\Entity\Temoin"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/temoin/add")
     * @return Temoin
     */
    public function postTemoinAction(Request $request){
        //return $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $object =$em->getRepository('AssureurBundle:Temoin')->find(1);

        $serializer = $this->get('serializer');
        $json = $serializer->serialize($object,'json');
        //return $json;
        $d = $serializer->deserialize($json,Temoin::class,'json',array('object' => $object));
        return d;

        $temoin = new Temoin();
        $form = $this->createForm(TemoinType::class,$temoin);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $em->persist($temoin);
            $em->flush();
            return $temoin;
        }
        else{
            return $form->getErrors();
        }

    }

    /**
     * @ApiDoc(
     *  section="Temoin",
     *  description="Edit Object",
     *  input="AssureurBundle\Form\Type\TemoinType",
     *  output="AssureurBundle\Entity\Temoin"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_ACCEPTED)
     * @Rest\Put("/api/temoin/edit/{id}")
     * @return Temoin
     */
    public function putTemoinAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $temoin = $em->getRepository('AssureurBundle:Temoin')->findOneBy(array('id' => $id,'deleted' => false));
        if(empty($temoin))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $form = $this->createForm(TemoinType::class,$temoin);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $em->flush();
            return $temoin;
        }
        else{
            return $form->getErrors();
        }
    }


    /**
     * @ApiDoc(
     *  section="Temoin",
     *  description="Get Object By ID",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Temoin ID"
     *      }
     *  }
     * )
     * @param $id
     * @Rest\View
     * @Rest\Get("/api/temoin/{id}")
     * @return Temoin
     */
    public function getTemoinByIdAction($id){
        $em = $this->getDoctrine()->getManager();
        $temoin = $em->getRepository('AssureurBundle:Temoin')->findOneBy(array(
            'id' => $id,
            'deleted' => false
        ));
        if(empty($temoin))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $temoin;
    }

    /**
     * @ApiDoc(
     *  section="Temoin",
     *  description="Get Objects By Accident ID",
     * requirements={
     *      {
     *          "name"="accident_id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Accident ID"
     *      }
     *  }
     * )
     * @param $accident_id
     * @Rest\View
     * @Rest\Get("/api/temoins/{accident_id}/liste")
     * @return \ArrayObject
     */
    public function getTemoinsByAccidentIdAction($accident_id){
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AssureurBundle:Temoin')->findBy(array(
            'deleted' => false,
            'accidentId' => $accident_id
        ));
        if(empty($liste))
        {
            return new JsonResponse(['message' => 'Aucun témoin trouvé'],404);
        }
        return $liste;
    }

    /**
     * @ApiDoc(
     *  section="Temoin",
     *  description="Delete Object",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Temoin ID"
     *      }
     *  }
     * )
     * @param $id
     * @Rest\View(statusCode=204)
     * @Rest\Delete("/api/temoin/delete/{id}")
     * @return null
     */
    public function deleteTemoinAction($id){
        $em = $this->getDoctrine()->getManager();
        $temoin = $em->getRepository('AssureurBundle:Temoin')->findOneBy(array(
            'id' => $id,
            'deleted' => false
        ));
        if(empty($temoin))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $temoin->setDeleted(true);
        $em->flush();
        return new JsonResponse(['message' => 'supprimé'],204);
    }
}