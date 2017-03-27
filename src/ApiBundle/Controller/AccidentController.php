<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

use AssureurBundle\Entity\Accident;
use AssureurBundle\Form\Type\AccidentType;

class AccidentController extends Controller{
    /**
     * @Rest\View
     * @Rest\Post("api/accident/add")
     * @param Request $request
     * @return Accident
     */
    public function postAccidentAction(Request $request) {
        $accident = new Accident();
        $form = $this->createForm(AccidentType::class,$accident);
        $form->submit($request->request->all());
        
        if($form->isSubmitted())
        {
            $accident->setCoord1($request->request->get('coord1'));
            $accident->setCoord2($request->request->get('coord2'));
            $accident->setDescription($request->request->get('description'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($accident);
            $em->flush();
            return $accident;
        }
    }
}


