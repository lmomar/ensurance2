<?php
<<<<<<< Upstream, based on origin/master
namespace ApiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\JsonResponse;

use AssureurBundle\Entity\Dossier;

use AssureurBundle\Form\Type\DossierType;


class DossierController extends Controller{
	
	
	
	/**
     * @Rest\View
     * @Rest\Post("api/dossier/add")
     * @param Request $request
     * @return AccideDossiernt
     */
	
	public function postDossierAction(Request $request){
		$dossier = New Dossier();
		$data = json_encode($request->getContent(),true);
		$form = $this->createForm(new DossierType(),$dossier);

		$form->submit($data);
		if($form->isValid())
		 {
			/*$dossier->setDateOuverture($request->request->get('date_ouverture'));
			$dossier->setDateFermeture($request->request->get('date_ouverture'));
            $dossier->setStatut($request->request->get('statut'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();*/

			return $dossier;
		 }
		 else{
		    return $form->getErrors();
         }
		
	}
	
	
	
	public function putDossierAction(Request $request){
		
		
	}
	
	
	public function getDossierAction(Request $request){
		
		
	}
	
}
=======
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



class DossierController extends Controller
{
    /**
     * @param Request $request
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/dossier/add")
     * @return Dossier
     */
    public function postDossierAction(Request $request){
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class,$dossier);
        $form->submit($request->request->all());
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
        $form->submit($request->request->all());
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
}
>>>>>>> 00c7e78 ensurance dossier web service
