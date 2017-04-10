<?php

namespace ApiUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiUserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiUserBundle\Form\Type\RegistrationFormType;



class RegistrationController extends Controller {

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/adduser")
     */
    function postUserAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->submit($request->request->all());
        //$form->handleRequest($request);
        if ($form->isValid()) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            if ($userManager->findUserByEmail($email)) {
                return new JsonResponse(array('email' => 'exist'));
            }
            $user->setUsername($email);
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setPlainPassword($password);
            $user->setRoles(array('ROLE_USER'));
            $userManager->updateUser($user, true);
            return $user;
        } else {
            return $form;
        }
    }

}
