<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use AssureurBundle\Entity\Devis;
use AssureurBundle\Form\Type\DevisType;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DevisController extends Controller{

    /**
     * @ApiDoc(
     *  section="Devis",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\DevisType",
     *  output="AssureurBundle\Entity\Devis"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/devis/add")
     * @return Accident
     */
    public function postDevisAction(Request $request){
        $devis = new Devis();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(DevisType::class,$devis);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $dossierId = $request->request->get($form->getName())['dossier'];
            $dossier  = $this->getDoctrine()->getRepository('AssureurBundle:Dossier')->find($dossierId);
            if(empty($dossier)){
                return new JsonResponse(['message' => 'not found'],404);
            }

            $file = $request->files->get($form->getName())['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/devis/', $fileName);
            $fullUrl =  '/uploads/photo/devis/' .  $fileName;
            $devis->setUrl($fullUrl);
            $devis->setDossier($dossier);
            $em->persist($devis);
            $em->flush();
            return $devis;
        }
        else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  section="Devis",
     *  description="Edit Object via Post(file upload)",
     *  input="AssureurBundle\Form\Type\DevisType",
     *  output="AssureurBundle\Entity\Devis",
     *    requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Devis Id"
     *      }
     *  }
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_ACCEPTED)
     * @Rest\Post("/api/devis/edit/{id}")
     * @return Accident
     */
    public function postDevisEditAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $devisToEdit = $em->getRepository('AssureurBundle:Devis')->findOneBy(array('deleted' => false,'id' => $id));

        if(empty($devisToEdit))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $devis = new Devis() ;
        $form = $this->createForm(DevisType::class,$devis);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $dossierId = $request->request->get($form->getName())['dossier'];
            $dossier  = $this->getDoctrine()->getRepository('AssureurBundle:Dossier')->find($dossierId);
            if(empty($dossier)){
                return new JsonResponse(['message' => 'not found'],404);
            }
            $file = $request->files->get('devis')['url'];
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photo_directory') . '/devis/', $fileName);
            $fullUrl =  '/uploads/photo/devis/' .  $fileName;
            $devisToEdit->setUrl($fullUrl);
            $devisToEdit->setDossier($dossier);
            $em->flush();
            return $devisToEdit;
        }
        else{
            return $form->getErrors();
        }
    }
    /**
     *
     * @ApiDoc(
     *  section="Devis",
     *  description="Delete Object",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Devis ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Delete("/api/devis/delete/{id}")
     * @return JsonResponse
     */
    public function deleteDevisAction($id){
        $em = $this->getDoctrine()->getManager();
        $devis= $em->getRepository('AssureurBundle:Devis')->findOneBy(array('deleted' => false,'id' => $id));
        if(empty($devis))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        $devis->setDeleted(true);
        $em->flush();
        return new JsonResponse(['message' => 'deleted'],Response::HTTP_NO_CONTENT);
    }

    /**
     * @ApiDoc(
     *  section="Devis",
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
     * @Rest\Get("/api/devis/dossier/{dossierId}")
     */
    public function getDevisByDossierIdAction($dossierId){
        $em = $this->getDoctrine()->getManager();
        $devis= $em->getRepository('AssureurBundle:Devis')->findBy(array('deleted' => false,'dossier' => $dossierId));
        if(empty($devis))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $devis;
    }
}