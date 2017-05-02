<?php
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
