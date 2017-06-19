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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends Controller {

    /**
     * @ApiDoc(
     *  section="User",
     *  description="Login By email and password",
     *  output="ApiUserBundle\Entity\User",
     *  requirements={
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "requirement"=".+",
     *          "description"="return one Object"
     *      },{
     *          "name"="password",
     *          "dataType"="string",
     *          "requirement"=".+",
     *          "description"="return one Object"  
     *        },
     *
     *
     *  }
     * )
    /**
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/login")
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
     * @ApiDoc(
     *  section="User",
     *  description="Edit Profile",
     *  input="ApiUserBundle\Form\Type\ProfileFormType",
     *  output="ApiUserBundle\Entity\User",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="return one Object"
     *      }
     *  }
     * )
    /**
     * @Rest\View()
     * @Rest\Post("/profile/{id}")
     * @param Request $request
     */
    public function updateProfileAction(Request $request) {
        $user_manager = $this->get('fos_user.user_manager');
        $id = $request->request->get('id');
        $user = $user_manager->findUserBy(array('id' => $id));
        $form = $this->createForm(ProfileFormType::class,$user);
        $form->submit($request->request->get($form->getName()));
        if($form->isSubmitted())
        {
            $file = $request->files->get($form->getName())['photo'];
            if(isset($file)){
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('photo_directory') . '/users/', $fileName);
                $fullUrl =  '/uploads/photo/users/' .  $fileName;
                $user->setPhoto($fullUrl);
            }

            $user_manager->updateUser($user);
            return $user;
        }
        
        //return new JsonResponse(array('message' => 'user_saved', 'user' => $reports));
    }

    /**
     * @Rest\View()
     * @Rest\Put("/change_password/{id}")
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
     * @ApiDoc(
     *  section="User",
     *  description="Get Object By ID",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="User ID"
     *      }
     *  }
     * )
    /**
    /**
     * @Rest\View()
     * @Rest\Get("/profile/get/{id}",name="getprofileuser")
     */
    public function getUserAction(Request $request){
        $id = $request->get('id');

        $user_manager= $this->get('fos_user.user_manager');
        $user = $user_manager->findUserBy(array('id' => $id));
        if(empty($user))
        {
            return new JsonResponse(['message' => 'not found'],Response::HTTP_NOT_FOUND);
        }
        return $user;
    }

}
