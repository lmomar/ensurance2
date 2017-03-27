<?php



namespace AssureurBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

use \Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use AssureurBundle\Form\Type\PhotoType;

use AssureurBundle\Entity\Photo;

use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\JsonResponse;



class UploadController extends Controller {



    /**

     * @Rest\Post("/api/upload")

     * @Rest\View

     * 

     */

    public function postPhotoAction(Request $request) {



        $photo = new Photo();

        $form = $this->createForm(PhotoType::class, $photo);

        $form->submit($request->request->all());

        if ($form->isSubmitted()) {

            $files = $request->files->all();

            $contat_id = $request->request->get('constat_id');


            foreach ($files['url'] as $f) {

                

                $filename = md5(uniqid()) . '.' . $f->guessExtension();

                $f->move($this->getParameter('photo_directory'), $filename);

                $photo = new Photo();

                $photo->setUrl($filename);

                $photo->setConstatId($contat_id);
                

                $em = $this->getDoctrine()->getManager();

                $em->persist($photo);

                $em->flush();

            }

            return new JsonResponse(array('message' => 'uploaded'), Response::HTTP_CREATED);

        }

    }



}

