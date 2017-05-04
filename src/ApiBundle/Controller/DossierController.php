<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/05/2017
 * Time: 09:47
 */

namespace ApiBundle\Controller;

use AssureurBundle\Entity\Dossier;
use AssureurBundle\Form\Type\DossierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DossierController extends Controller
{
    /**
     * @ApiDoc(
     *  section="Dossier",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\DossierType",
     *  output="AssureurBundle\Entity\Dossier"
     * )
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/dossier/add")
     * @return Dossier
     */
    public function postDossierAction(Request $request){
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class,$dossier);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();
            return $dossier;
        }
        else{
            return new JsonResponse(['message' => $form->getErrors()]);
        }
    }

    /**
     * @ApiDoc(
     *  section="Dossier",
     *  description="Edit Object",
     *  input="AssureurBundle\Form\Type\DossierType",
     *  output="AssureurBundle\Entity\Dossier",
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
     * @return null|object|Response
     * @Rest\View
     * @Rest\Put("/api/dossier/edit/{id}")
     */
    public function putDossierAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $dossier = $em->getRepository('AssureurBundle:Dossier')->find($id);
        if(empty($dossier)){
            return new Response(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DossierType::class,$dossier);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {

            $em->flush();
            return $dossier;
        }
        else{
            return $form->getErrors();
        }
    }

    /**
     * @ApiDoc(
     *  section="Dossier",
     *  description="Get Object By ID",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Dossier ID"
     *      }
     *  }
     * )
     * @param $id
     * @return null|object|Response
     * @Rest\View()
     * @Rest\Get("/api/dossier/get/{id}")
     */
    public function getDossierAction($id){
        $em = $this->getDoctrine()->getManager()->getRepository('AssureurBundle:Dossier');
        $dossier = $em->find($id);
        if(empty($dossier))
        {
            return new JsonResponse(array('message' => 'not found'),Response::HTTP_NOT_FOUND);
        }
        return $dossier;
    }

    /**
     * @ApiDoc(
     *  section="Dossier",
     *  description="Get Object By Accident ID",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Accident ID"
     *      }
     *  }
     * )
     * @param $id
     * @return null|object|Response
     * @Rest\View()
     * @Rest\Get("/api/dossier/accident/{id}")
     */
    public function getDossierByAccidentIdAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager()->getRepository('AssureurBundle:Dossier');
        $dossier = $em->findBy(array('accidentId' => $id));
        if(empty($dossier))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $dossier;
    }
}

