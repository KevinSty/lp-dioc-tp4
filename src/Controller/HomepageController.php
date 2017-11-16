<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;

class HomepageController extends Controller {
    /**
     * @Route(
     *     path="/",
     *     name="homepage"
     * )
     */
    public function homepageAction() {

        $em = $this->getDoctrine()->getRepository(User::class);
        $users = $em->findBy(array("isAdmin" => false));

        return $this->render('Homepage/homepage.html.twig', ['users' => $users]);
    }
}
