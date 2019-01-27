<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class SingaporeController extends AbstractController
{

    /**
     * [journal_content description]
     * @Route("/singapour", name="singapore")
     * @return Response [description]
     */
    public function singapore_content(): Response
    {
        return $this->render('pages/countries/show.html.twig');
    }

}

 ?>
