<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ThailandController extends AbstractController
{

    /**
     * @Route("/thailande", name="thailand.index")
     * @return Response [description]
     */
    public function thailand_index(): Response
    {
        return $this->render('pages/countries/index.html.twig');
    }

}

 ?>
