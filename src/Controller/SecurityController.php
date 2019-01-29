<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;


class SecurityController extends AbstractController
{


    /**
     * [login description]
     * @Route("/login", name="login")
     * @return Response [description]
     */
    public function login(AuthenticationUtils $authenticationutils): Response
    {
        $error = $authenticationutils ->getLastAuthenticationError();
        $lastUsername = $authenticationutils ->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' =>  $lastUsername,
            'error' => $error
        ]);
    }

}

 ?>
