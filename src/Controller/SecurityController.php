<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserType;

class SecurityController extends Controller {
    /**
     * @Route(
     *     path="/login",
     *     name="login"
     * )
     */
    public function loginAction(AuthenticationUtils $authUtils) {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('Security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route(
     *     path="/register",
     *     name="register"
     * )
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        // FIXME: Instancier le formulaire et à la soumission enregistrer le user.
        // La vue à rendre : Security/register.html.twig

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $encoded = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($encoded);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render("Security/register.html.twig", array('form' => $form->createView()));
    }
}
