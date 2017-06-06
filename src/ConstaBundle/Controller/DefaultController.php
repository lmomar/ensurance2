<?php

namespace ConstaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/consta", name="home_consta")
     */
    public function indexAction()
    {
        $path =  $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
        //return new Response($path);
        //Set the Content Type
        header('Content-type: image/jpeg');

        // Create Image From Existing File
        $image = $path . '/constat.jpg';
        $jpg_image = imagecreatefromjpeg($image);

        // Allocate A Color For The Text
        $white = imagecolorallocate($jpg_image, 0, 0, 0);

        // Set Path to Font File
        $font_path = $path . '/arial.TTF';
        //return new Response($font_path);

        // Set Text to Be Printed On Image
        $text = "ab-rtqsdf";

        // Print Text On Image
        imagettftext($jpg_image, 16, 0, 82, 279, $white, $font_path, $text);

        // Send Image to Browser
        imagejpeg($jpg_image,$path .'/newConstat.jpg');
        imagejpeg($jpg_image);

        // Clear Memory
        //imagedestroy($jpg_image);
    }
}
