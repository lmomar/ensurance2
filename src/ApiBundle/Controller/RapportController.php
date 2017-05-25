<?php
namespace ApiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

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
     * @return Rapport
    */
    public function postRapportAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rapport = new Rapport();
        $form = $this->createForm(RapportType::class, $rapport);
        $form->submit($request->request->get($form->getName()));

        if ($form->isSubmitted()) {
            $dossier_id = $request->request->get('rapport')['dossier'];
            $dossier = $this->getDoctrine()->getRepository('AssureurBundle:Dossier')->getOne(1);
            //return $dossier;
            if (empty($dossier)) {
                return new JsonResponse(array('message' => 'dossier not found'));
            } else {
                $rapport->setDossier($dossier);
                $em->persist($rapport);
                $em->flush();
                return $rapport;
            }

        }

        else{
            return new JsonResponse($form->getErrors());
        }
    }

    /**
     * @ApiDoc(
     *  section="Rapport",
     *  description="Get Object By ID",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Rapport ID"
     *      }
     *  }
     * )
     * @param $id
     * @Rest\View
     * @Rest\Get("/api/rapport/{id}")
     * @return Rapport
     */
    public function getRapportAction(Request $request,$id){
        $rep = $this->getDoctrine()->getManager()->getRepository('AssureurBundle:Rapport');
        $rapport = $rep->getOne($id);
        /*if(empty($rapport))
        {
            return new JsonResponse(array('message' => 'not found'));
        }*/
        return $rapport;

    }

}