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
        $username = $request->request->get('email');
        $password = $request->request->get('password');


        $user = $user_manager->findUserByEmail($username);
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
        $userManager = $this->container->get('fos_user.user_manager');
        //$user = $userManager->findUserBy(array('id' => $request->request->get('id')));
        $query = $this->getDoctrine()->getEntityManager()
                ->createQuery('SELECT u.id,u.nom,u.prenom,u.email,u.phone,u.date_naissance,u.date_driver_license FROM ApiUserBundle:User u'
                        . ' where u.id = :id')
                ->setParameter('id', $request->request->get('id'));
        $data = $query->getSingleResult();
        /* if (empty($user)) {
          return new JsonResponse(array('message' => 'Utilisateur introuvable !!!'), Response::HTTP_NOT_FOUND);
          }
          $nom = $request->request->get('nom');
          $prenom = $request->request->get('prenom');
          $phone = $request->request->get('phone');
          $date_naissance = $request->request->get('date_naissance');
          $driver_date_license = $request->request->get('driver_date_license');
          $email = $request->request->get('email');
          $user->setNom($nom);
          $user->setPrenom($prenom);
          $user->setPhone($phone);
          $user->setDateNaissance($date_naissance);
          $user->setDriverDateLicense($driver_date_license);
          $user->setEmail($email);
          $userManager->updateUser($user); */


        /* $userManager = $this->get('fos_user.user_manager');
          $user = $userManager->findUserBy(array('id' => '1')); */
        $user = new Serializer(array(
            new JsonClassHintingNormalizer(),
                ), array(
            'json' => new JsonEncoder(),
        ));
        return $s->deserialize($data, $user, 'json');

        //$user->setId($data['id']);
        //$data['nom']? $user->setNom($data['nom']) : ;
        $user->setPrenom($data['prenom']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setDateNaissance($data['date_naissance']);
        $user->setDateDriverLicense($data['date_driver_license']);

        $form = $this->createForm(ProfileFormType::class, $user);
        return $form;
        //$form->submit($request->request->all());
        /*
          if($form->isValid())
          {
          //$userManager->updateUser($user);
          return $user;
          }
          else{
          return $form;
          } */
    }

    /**
     * @Rest\View()
     * @Rest\Put("/api/change_password/{id}")
     */
    public function updatePassword(Request $request) {
        
    }

}
