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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class UploadController extends Controller
{

    /**
     * @ApiDoc(
     *  section="Photo",
     *  description="Create a new Object",
     *  input="AssureurBundle\Form\Type\PhotoType",
     *  output="AssureurBundle\Entity\Photo"
     * )
     * @Rest\Post("/api/upload")
     * @Rest\View
     *
     */
    public function postPhotoAction(Request $request)
    {
        //return new JsonResponse(['message' => 'OK']);
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->submit($request->request->get($form->getName()));

        if ($form->isSubmitted()) {
            $files = $request->files->all();
            $accident_id = $request->request->get($form->getName())['accident'];
            $accident = $this->getDoctrine()->getManager()
                ->getRepository('AssureurBundle:Accident')->find($accident_id);
            if (empty($accident)) {
                return new JsonResponse(['message' => 'no accident found'], 404);
            }
            $em = $this->getDoctrine()->getManager();
            foreach ($files['url'] as $f) {
                $filename = md5(uniqid()) . '.' . $f->guessExtension();
                $f->move($this->getParameter('photo_directory') . '/accident/photo', $filename);
                $fullUrl = '/uploads/photo/accident/' . $filename;
                $photo = new Photo();
                $photo->setUrl($fullUrl);
                $photo->setAccident($accident);
                $photo->setType('photo');
                $em->persist($photo);
                $em->flush();
            }
            return new JsonResponse(array('message' => 'ok'));
        }
    }
}

