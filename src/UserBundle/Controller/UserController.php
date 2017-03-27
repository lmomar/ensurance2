<?php
namespace UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
class UserController extends Controller{
    
    /**
     * @Route("/admin/users", name="users_list")
     */
    public function index() {
        $userManager = $this->get("fos_user.user_manager");
        $users = $userManager->findUsers();
        //dump($users);die();
        return $this->render('UserBundle:User:index.html.twig', array('users' => $users));
        
    }
}
