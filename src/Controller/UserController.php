<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {

    /**
     * @Route(
     *     path="/my_profile",
     *     name="myprofile"
     * )
     */
    public function myProfileAction() {
        return $this->render('User/my_profile.html.twig');
    }

    /**
     * @Route(
     *     path="/profile/{id}",
     *     name="profile_id"
     *     @param User $user
     * )
     */
    public function profileAction(User $user) {

        // FIXME: un utilisateur connecté qui se rend sur sa propre page est redirigé vers /my_profile
        if ($user === $this->getUser()) {
            return $this->redirect($this->generateUrl('app_user_myprofileaction'));
        }

        return $this->render('User/profile.html.twig', ['user' => $user]);
    }
}
