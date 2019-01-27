<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class MalaysiaController extends AbstractController
{

    /**
     * @Route("/malaisie", name="malaysia.index")
     * @return Response [description]
     */
    public function malaysia_index(): Response
    {
        return $this->render('pages/countries/index.html.twig');
    }

}

 ?>
