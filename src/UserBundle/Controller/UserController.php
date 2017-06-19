<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ApiUserBundle\Entity\User;
use UserBundle\Form\Type\RegistrationFormType;
use UserBundle\Form\Type\ProfileFormType;
class UserController extends Controller {

    /**
     * @Route("/", name="users_list")
     */
    public function index() {
        $userManager = $this->get("fos_user.user_manager");
        $users = $userManager->findUsers();
        //dump($users);die();
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        return $this->render('UserBundle:User:index.html.twig', array('users' => $users,'form' =>
        $form->createView()));
    }

    /**
     * @Route("/user/add",name="add_user")
     */
    public function addUserAction(Request $request) {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        //$form->submit($request->request->all());
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $userManager = $this->get('fos_user.user_manager');
            //print('<pre>');var_dump($form->getData());die();
            $data = $form->getData();
            $email = $data->getEmail();
            if ($userManager->findUserByEmail($email)) {
                $this->addFlash('error', 'Email existe déjà');
                return $this->render('UserBundle:User:adduser.html.twig', ['form' => $form->createView()]);
            }
            $user = $userManager->createUser();
            //$user->setUsername($email);
            $user->setNom($data->getNom());
            $user->setPrenom($data->getPrenom());
            $user->setDateNaissance($data->getDateNaissance());
            $user->setPhone($data->getPhone());
            $user->setRoles($data->getRoles());
            $user->setEmail($email);
            $user->setUsername($email);
            $user->setEnabled(true);
            $user->setPlainPassword($data->getPlainPassword());

            $userManager->updateUser($user, true);
            //var_dump($user);die();
            $this->addFlash('success', 'Utilisateur ajouté avec succés');
            return $this->redirect($this->generateUrl('users_list'));
        } else {
            return $this->render('UserBundle:User:adduser.html.twig', ['form' => $form->createView()]);
        }
    }

    /**
     * @Route("/user/edit/{id}",name="edit_user")
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function editUserAction(Request $request, $id) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            //var_dump($user->getId());echo "|";var_dump($id);die();
            $user->setUsername($user->getEmail());
            $user->setUsernameCanonical($user->getEmail());
            $userManager->updateUser($user,true);
            $this->addFlash('success', 'Utilisateur modifié avec succés');
            return $this->redirect($this->generateUrl('users_list'));
        } else {
            return $this->render('UserBundle:User:edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
        }
    }
    /**
     * @Route("/user/disable/{id}",name="disable_user")
     * @param Request $request
     * @param type $id
     */
    public function deleteUser(Request $request,$id){
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        if(isset($user)){
            $user->setEnabled(false);
            $userManager->updateUser($user,true);
            $this->addFlash('success','Utilisateur désactivé');
            return $this->redirect($this->generateUrl('users_list'));
        }
        $this->addFlash('error','Utilisateur non trouvé');
        return $this->redirect($this->generateUrl('users_list'));
    }

}
