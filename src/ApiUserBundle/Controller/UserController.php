<?php

namespace ApiUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiUserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends Controller {

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/login")
     */
    public function postLoginAction(Request $request) {
        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $username = $request->request->get('email');
        $password = $request->request->get('password');


        $user = $user_manager->findUserByEmail($username);
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);

        if($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt()))
        {
            return $user;
        }
        else{
            return false;
        }
    }

}
