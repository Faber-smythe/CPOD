<?php

namespace App\Controller;

use \DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class MapController extends AbstractController
{

    /**
     * [map_content description]
     * @Route("/c-est-par-ou", name="map")
     * @return Response [description]
     */
    public function map_content(): Response
    {
        // Get the number of days of the journey so far
        $start_date = new DateTime('2018-8-31');
        $start_stamp = $start_date->getTimestamp();
        $today_date = new DateTime();
        $today_stamp = $today_date->getTimestamp();
        $how_many_seconds = $today_stamp-$start_stamp;
        $how_many_days = (int)($how_many_seconds/86400);


        return $this->render('pages/map.html.twig', [
            'how_many_days' => $how_many_days
        ]);
    }

}

 ?>
