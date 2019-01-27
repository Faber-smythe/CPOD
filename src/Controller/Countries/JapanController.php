<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class JapanController extends AbstractController
{

    /**
     * [journal_content description]
     * @Route("/japon", name="japan.index")
     * @return Response [description]
     */
    public function japan_index(): Response
    {
        return $this->render('pages/countries/index.html.twig');
    }

}

 ?>
