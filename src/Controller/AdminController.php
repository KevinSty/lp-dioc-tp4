<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller {
    /**
     * @Route(
     *     path="",
     *     name="admin_dashboard"
     * )
     */
    public function dashboardAction() {

        $em = $this->getDoctrine()->getRepository(User::class);
        $users = $em->findBy(array("isAdmin" => false));

        return $this->render('Admin/dashboard.html.twig', ['users' => $users]);
    }


    /**
    * @Route(
    *     path="/delete-user/{id}",
    *     name="admin_delete_user")
    *     @param User $user
    */
    public function deleteUserAction(User $user)
    {
        // FIXME: Supprime l'utilisateur est redirige sur /admin, la route doit être /delete-user/1
    }
}
