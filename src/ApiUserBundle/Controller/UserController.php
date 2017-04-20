<?php

namespace ApiUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiUserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiUserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use JsonClassHintingNormalizer;

class UserController extends Controller {

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/login")
     */
    public function postLoginAction(Request $request) {
        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $user = $user_manager->findUserByEmail($email);
        if(empty($user)){
            return new JsonResponse(['message','email not found'],Response::HTTP_NOT_FOUND);
        }
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/api/profile/{id}")
     * @param Request $request
     */
    public function updateProfileAction(Request $request) {
        $user_manager = $this->get('fos_user.user_manager');
        
        $email = $request->request->get('email');
        $user = $user_manager->findUserByEmail($email);
        $nom = $request->request->get('nom');
        $prenom = $request->get('prenom');
        $date_naissance = new \DateTime($request->request->get('date_naissance'));
        $date_driver_license = new \DateTime($request->request->get('date_driver_license'));
        $phone = $request->request->get('phone');
        $user->setNom($nom);
        $user->setEmail($email);
        $user->setPrenom($prenom);
        $user->setDateNaissance($date_naissance);
        $user->setDateDriverLicense($date_driver_license);
        $user->setPhone($phone);
        $user->setCin($request->get('cin'));
        $user_manager->updateUser($user, true);
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($user, 'json');
        
        return new JsonResponse(array('message' => 'user_saved', 'user' => $reports));
    }

    /**
     * @Rest\View()
     * @Rest\Put("/api/change_password/{id}")
     * @param Request $request
     */
    public function updatePasswordAction(Request $request) {        
        $user_manager= $this->get('fos_user.user_manager');
        $email = $request->request->get('email');
        $user = $user_manager->findUserByEmail($email);
        $password = $request->request->get('password');
        $user->setPlainPassword($password);
        $user_manager->updateUser($user,true);
        return new JsonResponse(array('message' => 'password_changed'));
    }
    
    
    /**
     * @Rest\View()
     * @Rest\Get("/api/profile/get/{id}",name="getProfile")
     */
    public function getProfileAction(Request $request) {
        $id = $request->get('id');
        $user_manager= $this->get('fos_user.user_manager');
        $user = $user_manager->findUserBy(array('id' => $id));
        return $user;
    }

}
