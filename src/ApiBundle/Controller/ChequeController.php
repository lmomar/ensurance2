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

class ChequeController extends Controller{

    /**
     * @ApiDoc(
     *  section="Cheque",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\ChequeType",
     *  output="AssureurBundle\Entity\Cheque"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/cheque/add")
     * @return Cheque
     */
    public function postChequeAction(Request $request){
        $cheque = new Cheque();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ChequeType::class,$cheque);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $dossierId = $request->request->get($form->getName())['dossier'];
            $dossier  = $this->getDoctrine()->getRepository('AssureurBundle:Dossier')->find($dossierId);
            if(empty($dossier)){
                return new JsonResponse(['message' => 'not found'],404);
            }
            $file = $request->files->get('cheque')['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/cheque/', $fileName);
            $fullUrl =  '/uploads/photo/cheque/' .  $fileName;
            $cheque->setUrl($fullUrl);
            $cheque->setDossier($dossier);
            $em->persist($cheque);
            $em->flush();
            return $cheque;
        }
        else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  section="Cheque",
     *  description="Edit Object via Post(file upload)",
     *  input="AssureurBundle\Form\Type\ChequeType",
     *  output="AssureurBundle\Entity\Cheque",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Cheque ID"
     *      }
     *  }
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_ACCEPTED)
     * @Rest\Post("/cheque/edit/{id}")
     * @return Cheque
     */
    public function postChequeEditAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $chequeToEdit = $em->getRepository('AssureurBundle:Cheque')->findOneBy(array('deleted' => false,'id' => $id));

        if(empty($chequeToEdit))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $cheque = new Cheque() ;
        $form = $this->createForm(ChequeType::class,$cheque);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $dossierId = $request->request->get($form->getName())['dossier'];
            $dossier  = $this->getDoctrine()->getRepository('AssureurBundle:Dossier')->find($dossierId);
            if(empty($dossier)){
                return new JsonResponse(['message' => 'not found'],404);
            }
            $file = $request->files->get('cheque')['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/cheque/', $fileName);
            $fullUrl =  '/uploads/photo/cheque/' .  $fileName;
            $chequeToEdit->setUrl($fullUrl);
            $chequeToEdit->setDossier($dossier);
            $em->flush();
            return $chequeToEdit;
        }
        else{
            return $form->getErrors();
        }
    }
    /**
     *
     * @ApiDoc(
     *  section="Cheque",
     *  description="Delete Object",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Cheque ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Delete("/cheque/delete/{id}")
     * @return JsonResponse
     */
    public function deleteChequeAction($id){
        $em = $this->getDoctrine()->getManager();
        $cheque= $em->getRepository('AssureurBundle:Cheque')->findOneBy(array('deleted' => false,'id' => $id));
        if(empty($cheque))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $cheque->setDeleted(true);
        $em->flush();
        return new JsonResponse(['message' => 'deleted'],Response::HTTP_NO_CONTENT);
    }

    /**
     * @ApiDoc(
     *  section="Cheque",
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
     * @Rest\Get("/cheque/dossier/{dossierId}")
     */
    public function getChequeByDossierIdAction($dossierId){
        $em = $this->getDoctrine()->getManager();
        $cheque= $em->getRepository('AssureurBundle:Cheque')->findBy(array('deleted' => false,'dossier' => $dossierId));
        if(empty($cheque))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $cheque;
    }
}