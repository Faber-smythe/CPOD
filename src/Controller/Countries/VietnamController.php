<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class VietnamController extends AbstractController
{

    /**
     * @Route("/vietnam", name="vietnam.index")
     * @return Response [description]
     */
    public function vietnam_index(): Response
    {
        return $this->render('pages/countries/index.html.twig');
    }

}

 ?>
