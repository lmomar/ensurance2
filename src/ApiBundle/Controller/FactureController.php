<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use AssureurBundle\Entity\Cheque;
use AssureurBundle\Form\Type\ChequeType;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class FactureController extends Controller{

    /**
     * @ApiDoc(
     *  section="Facture",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\FactureType",
     *  output="AssureurBundle\Entity\Facture"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/facture/add")
     * @return Facture
     */
    public function postChequeAction(Request $request){
        $facture = new Facture();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(FactureType::class,$facture);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $file = $request->files->get('cheque')['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/facture/', $fileName);
            $fullUrl =  '/uploads/photo/facture/' .  $fileName;
            $facture->setUrl($fullUrl);
            $em->persist($facture);
            $em->flush();
            return $facture;
        }
        else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  section="Facture",
     *  description="Edit Object via Post(file upload)",
     *  input="AssureurBundle\Form\Type\FactureType",
     *  output="AssureurBundle\Entity\Facture",
     *    requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Facture Id"
     *      }
     *  }
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_ACCEPTED)
     * @Rest\Post("/api/facture/edit/{id}")
     * @return Facture
     */
    public function postModifAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $factureToEdit = $em->getRepository('AssureurBundle:Facture')->findOneBy(array('deleted' => false,'id' => $id));

        if(empty($factureToEdit))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $facture = new Facture() ;
        $form = $this->createForm(FactureType::class,$facture);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {

            $file = $request->files->get('cheque')['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/cheque/', $fileName);
            $fullUrl =  '/uploads/photo/facture/' .  $fileName;
            $factureToEdit->setUrl($fullUrl);
            $em->flush();
            return $factureToEdit;
        }
        else{
            return $form->getErrors();
        }
    }
    /**
     *
     * @ApiDoc(
     *  section="Facture",
     *  description="Delete Object",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Facture ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Delete("/api/facture/delete/{id}")
     * @return JsonResponse
     */
    public function deleteFactureAction($id){
        $em = $this->getDoctrine()->getManager();
        $cheque= $em->getRepository('AssureurBundle:Facture')->findOneBy(array('deleted' => false,'id' => $id));
        if(empty($facture))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $cheque->setDeleted(true);
        $em->flush();
        return new JsonResponse(['message' => 'deleted'],Response::HTTP_NO_CONTENT);
    }

    /**
     * @ApiDoc(
     *  section="Facture",
     *  description="Get Object By Dossier ID",
     * requirements={
     *      {
     *          "name"="dossierId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Dossier ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Get("/api/facture/dossier/{dossierId}")
     */
    public function getChequeByDossierIdAction($dossierId){
        $em = $this->getDoctrine()->getManager();
        $facture= $em->getRepository('AssureurBundle:Facture')->findOneBy(array('deleted' => false,'dossierId' => $dossierId));
        if(empty($facture))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $facture;
    }
}