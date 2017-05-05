<?php
namespace ApiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use AssureurBundle\Entity\Rapport;
use AssureurBundle\Form\Type\RapportType;
class RapportController extends Controller{

    /**
     * @ApiDoc(
     *  section="Rapport",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\RapportType",
     *  output="AssureurBundle\Entity\Rapport"
     * )
    * @Rest\View
    * @Rest\Post("/api/rapport/add")
    */
    public function postRapportAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $rapport = new Rapport();
        $form = $this->createForm(RapportType::class,$rapport);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $em->persist($rapport);
            $em->flush();
            return $rapport;
        }
        else{
            return $form->getErrors();
        }
    }

}