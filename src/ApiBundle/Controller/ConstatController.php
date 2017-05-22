<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use AssureurBundle\Entity\Constat;
use AssureurBundle\Form\Type\ConstatType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ConstatController extends Controller{

    /**
     * @ApiDoc(
     *  section="Constat",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\ConstatType",
     *  output="AssureurBundle\Entity\Constat"
     * )
     * @Rest\View
     * @Rest\Post("api/constat/add")
     * @param Request $request
     * @return Constat
     */
    public function postConstatAction(Request $request) {
        $constat = new Constat();
        $form = $this->createForm(ConstatType::class,$constat);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($constat);
            $em->flush();
            return $constat;
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\Form\FormErrorIterator|JsonResponse
     * @ApiDoc(
     *     section="Constat",
     *     description="Edit constat",
     *     input="AssureurBundle\Form\ConstatType",
     *     output="AssureurBundle\Entity\Constat",
     *     requirements={
     *     {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Constat ID"
     * }
*     }
     * )
     * @Rest\View()
     * @Rest\Put("/api/constat/{id}",name="constat_edit")
     */
    public function putConstatAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $constat = $em->getRepository('AssureurBundle:Constat')->findOneBy(array('id' => $id,'deleted' => false));
        if(empty($constat))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $form = $this->createForm(ConstatType::class,$constat);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $constat;
        }else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  section="Constat",
     *  description="Delete Constat by ID",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Constat ID"
     *      }
     *  },
     *  parameters={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"="Constat id"}
     *  }
     * )
     * @Rest\View()
     * @Rest\Delete("/api/constat/delete/{id}",name="constat_delete")
     */
    public function deleteConstatAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $constat = $em->getRepository('AssureurBundle:Constat')->findOneBy(array('id' => $id,'deleted' => false));
        if(empty($constat))
        {
            return new JsonResponse(array('message' => 'not found'),404);
        }
        $constat->setDeleted(true);
        return new JsonResponse(array('message' => 'Deleted'),201);
    }
}
