<?php
namespace ApiBundle\Controller;

use ApiUserBundle\Entity\Permis;
use AssureurBundle\Entity\Vehicule;
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
            $accidentID = $request->request->get($form->getName())['accident'];
            $accident = $this->getDoctrine()->getRepository('AssureurBundle:Accident')->find($accidentID);
            if(empty($accidentID))
            {
                return new JsonResponse(['message' => 'not found'],404);
            }
            $file= $request->files->get($form->getName())['pointChoc'];
            if(isset($file))
            {
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('photo_directory') . '/constat/', $filename);
                $fullUrl =  '/uploads/constat/' .  $filename;
                $constat->setPointChoc($fullUrl);
            }
            $signature= $request->files->get($form->getName())['signature'];
            if(isset($signature))
            {
                $filename = md5(uniqid()) . '.' . $signature->guessExtension();
                $signature->move($this->getParameter('photo_directory') . '/constat/', $filename);
                $fullUrl =  '/uploads/constat/' .  $filename;
                $constat->setSignature($fullUrl);
            }
            $em = $this->getDoctrine()->getManager();
            $constat->setAccident($accident);
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
            $accidentID = $request->request->get($form->getName())['accident'];
            $accident = $this->getDoctrine()->getRepository('AssureurBundle:Accident')->find($accidentID);
            if(empty($accidentID))
            {
                return new JsonResponse(['message' => 'not found'],404);
            }
            $file = $request->request->get($form->getName())['pointChoc'];
            if(isset($file))
            {
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('photo_directory') . '/constat/', $filename);
                $fullUrl =  '/uploads/constat/' .  $filename;
                $constat->setPointChoc($fullUrl);
            }
            $signature= $request->files->get($form->getName())['signature'];
            if(isset($signature))
            {
                $filename = md5(uniqid()) . '.' . $signature->guessExtension();
                $signature->move($this->getParameter('photo_directory') . '/constat/', $filename);
                $fullUrl =  '/uploads/constat/' .  $filename;
                $constat->setSignature($fullUrl);
            }
            $constat->setAccident($accident);
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

    /**
     * @ApiDoc(
     *  section="Constat",
     *  description="Get Object By ID",
     *  output="AssureurBundle\Entity\Constat",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Constat ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Get("/api/constat/get/{id}")
     * @return ConstatType
     */
    public function getConstatAction(Request $request,$id){
        $constat = $this->getDoctrine()->getRepository('AssureurBundle:Constat')->findOneBy(array(
            'deleted' => false,'id' => $id
        ));
        if(empty($constat))
        {
            return new JsonResponse(['message' => 'not found'],404);
        }
        return $constat;
    }

    /**
     * @ApiDoc(
     *  section="Constat",
     *  description="Get Objects By Constat ID",
     * requirements={
     *      {
     *          "name"="accidentID",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Accident ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Get("/api/constats/accident/{accidentID}")
     * @return Array()
     */
    public function getConstatsByAccidentAction(Request $request,$accidentID){
        $constats = $this->getDoctrine()->getRepository('AssureurBundle:Constat')->findBy(array(
            'deleted' => false,'accident' => $accidentID
        ));
        if(empty($constats))
        {
            return new JsonResponse(['message' => 'no constat found'],404);
        }
        return $constats;

    }

    /**
     * @ApiDoc(
     *  section="Constat",
     *  description="Generate image constat",
     * requirements={
     *      {
     *          "name"="accidentID",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Accident ID"
     *      }
     *  }
     * )
     * @Rest\View
     * @Rest\Get("/api/constat/generate/{accidentID}",name="generate_constat_jpg")
     * @param Request $request
     * @param $id
     * @return Constat|null|object|JsonResponse
     */
    public function getGenerateConstatAction(Request $request,$accidentID){
        $accident = $this->getDoctrine()->getManager()
            ->getRepository('AssureurBundle:Accident')
            ->find($accidentID);
        if(empty($accident))
        {
            return new JsonResponse(['message' => 'no consta found'],404);
        }

        $constats =  $accident->getConstats();
        $vehicules = $accident->getVehicules();
        $path =  $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
        //return new Response($path);
        //Set the Content Type
        //header('Content-type: image/jpeg');
        // Create Image From Existing File
        $image = $path . '/constat.jpg';
        $jpg_image = imagecreatefromjpeg($image);

        // Allocate A Color For The Text
        $color = imagecolorallocate($jpg_image, 0, 0, 0);

        // Set Path to Font File
        $font_path = $path . '/arial.TTF';
        //return new Response($font_path);
        // Set Text to Be Printed On Image
        $text = "ab-rtqsdf";

        // Print Text On Image
        $em = $this->getDoctrine()->getManager();
        /* constat data A*/
        $categorieVehicule = array('1' => 'voiture','2' => 'moto','3' => 'camion');
        $vehicule1 = new Vehicule();
        $vehicule1 = $vehicules[0];
        $constat1 = $constats[0];
        $user1 = $vehicule1->getUser();
        $permis = $em->getRepository('ApiUserBundle:Permis')->findOneBy(array('user' => $user1->getId(),
            'categorie' => $categorieVehicule[$vehicule1->getTypeId()] ));
        $permis = new Permis();
        $size = 14;
        //return $vehicule1->getValableDu()->format('Y-m-d');
        imagettftext($jpg_image, $size, 0, 69, 289, $color, $font_path, $vehicule1->getMarque() . '.' . $vehicule1->getModele());
        imagettftext($jpg_image, $size, 0, 78, 313, $color, $font_path, $vehicule1->getMatricule());
        imagettftext($jpg_image, $size, 0, 63, 330, $color, $font_path, $constat1->getVenantDe());
        imagettftext($jpg_image, $size, 0, 61, 345, $color, $font_path, $constat1->getAllantVers());
        imagettftext($jpg_image, $size, 0, 49, 389, $color, $font_path, $user1->getnom());
        imagettftext($jpg_image, $size, 0, 56, 402, $color, $font_path, $user1->getPrenom());
        imagettftext($jpg_image, $size, 0, 56, 416, $color, $font_path, $user1->getAdresse());
        imagettftext($jpg_image, $size, 0, 87, 447, $color, $font_path, $vehicule1->getNomAssurance());
        imagettftext($jpg_image, $size, 0, 84, 463, $color, $font_path, $vehicule1->getNumAttestation());
        imagettftext($jpg_image, $size, 0, 72, 477, $color, $font_path, $vehicule1->getNumPolice());
        imagettftext($jpg_image, $size, 0, 93, 510, $color, $font_path, $vehicule1->getValableDu()->format('Y-m-d'));
        imagettftext($jpg_image, $size, 0, 141, 510, $color, $font_path, $vehicule1->getValableAu()->format('Y-m-d'));
        imagettftext($jpg_image, $size, 0, 44, 567, $color, $font_path, $user1->getnom());
        imagettftext($jpg_image, $size, 0, 53, 580, $color, $font_path, $user1->getPrenom());
        imagettftext($jpg_image, $size, 0, 51, 596, $color, $font_path, $user1->getAdresse());
        imagettftext($jpg_image, $size, 0, 101, 623, $color, $font_path, $permis->getNumPermis());
        imagettftext($jpg_image, $size, 0, 130, 638, $color, $font_path, $permis->getDateDelivre());
        imagettftext($jpg_image, $size, 0, 91, 651, $color, $font_path, $permis->getPrefecture());
        imagettftext($jpg_image, $size, 0, 106, 663, $color, $font_path, $permis->getDateDelivre());/* + 12 ans PERMIS VALABLE JUSQAU */
        imagettftext($jpg_image, $size, 0, 22, 810, $color, $font_path, $constat1->getDescDegat());
        imagettftext($jpg_image, $size, 0, 22, 868, $color, $font_path, $constat1->getObservations());
        /* end data A*/
        /* dataa B*/
        $vehicule2 = new Vehicule();
        $vehicule2 = $vehicules[1];
        $constat2 = $constats[1];
        $user2 = $vehicule2->getUser();
        $permis = $em->getRepository('ApiUserBundle:Permis')->findOneBy(array('user' => $user1->getId(),
            'categorie' => $categorieVehicule[$vehicule1->getTypeId()] ));
        $permis = new Permis();

        imagettftext($jpg_image, $size, 0, 542, 280, $color, $font_path, $vehicule2->getMarque() . '.' . $vehicule2->getModele());
        imagettftext($jpg_image, $size, 0, 540, 309, $color, $font_path, $vehicule2->getMatricule());
        imagettftext($jpg_image, $size, 0, 539, 330, $color, $font_path, $constat2->getVenantDe());
        imagettftext($jpg_image, $size, 0, 541, 345, $color, $font_path, $constat2->getAllantVers());
        imagettftext($jpg_image, $size, 0, 539, 389, $color, $font_path, $user2->getnom());
        imagettftext($jpg_image, $size, 0, 539, 402, $color, $font_path, $user2->getPrenom());
        imagettftext($jpg_image, $size, 0, 539, 416, $color, $font_path, $user2->getAdresse());
        imagettftext($jpg_image, $size, 0, 539, 447, $color, $font_path, $vehicule2->getNomAssurance());
        imagettftext($jpg_image, $size, 0, 539, 463, $color, $font_path, $vehicule2->getNumAttestation());
        imagettftext($jpg_image, $size, 0, 539, 477, $color, $font_path, $vehicule2->getNumPolice());
        imagettftext($jpg_image, $size, 0, 539, 510, $color, $font_path, $vehicule2->getValableDu()->format('Y-m-d'));
        imagettftext($jpg_image, $size, 0, 539, 510, $color, $font_path, $vehicule2->getValableAu()->format('Y-m-d'));
        imagettftext($jpg_image, $size, 0, 539, 567, $color, $font_path, $user2->getnom());
        imagettftext($jpg_image, $size, 0, 539, 580, $color, $font_path, $user2->getPrenom());
        imagettftext($jpg_image, $size, 0, 539, 596, $color, $font_path, $user2->getAdresse());
        imagettftext($jpg_image, $size, 0, 539, 623, $color, $font_path, $permis->getNumPermis());
        imagettftext($jpg_image, $size, 0, 539, 638, $color, $font_path, $permis->getDateDelivre());
        imagettftext($jpg_image, $size, 0, 539, 651, $color, $font_path, $permis->getPrefecture());
        imagettftext($jpg_image, $size, 0, 539, 663, $color, $font_path, $permis->getDateDelivre());/* + 12 ans PERMIS VALABLE JUSQAU */
        imagettftext($jpg_image, $size, 0, 539, 810, $color, $font_path, $constat2->getDescDegat());
        imagettftext($jpg_image, $size, 0, 539, 868, $color, $font_path, $constat2->getObservations());
        /* end data B*/

        imagettftext($jpg_image, 16, 0, 82, 279, $color, $font_path, $text);

        // Send Image to Browser
        imagejpeg($jpg_image,$path .'/newConstat.jpg');
        //imagejpeg($jpg_image);
        return true;


    }
}
