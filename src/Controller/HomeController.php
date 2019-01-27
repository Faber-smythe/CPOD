<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    /**
     * [homepage_content description]
     * @Route("/home", name="home")
     * @return Response [description]
     */
    public function homepage_content(): Response
    {
        return $this->render('pages/home.html.twig');
    }

}

 ?>
