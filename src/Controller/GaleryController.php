<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class GaleryController extends AbstractController
{

    /**
     * [journal_content description]
     * @Route("/fais-voir", name="galery")
     * @return Response [description]
     */
    public function galery_content(): Response
    {
        return $this->render('pages/galery.html.twig');
    }

}

 ?>
