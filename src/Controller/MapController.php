<?php

namespace App\Controller;

use \DateTime;
use App\Repository\CountryRepository;
use App\Repository\StageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class MapController extends AbstractController
{
    public function __construct(CountryRepository $countryrepository, StageRepository $stagerepository){
        $this->countryrepository = $countryrepository;
        $this->stagerepository = $stagerepository;
    }
    /**
     * [map_content description]
     * @Route("/c-est-par-ou", name="map")
     * @return Response [description]
     */
    public function map_content(): Response
    {
        $countries = $this->countryrepository->findAll();
        $itinerary = [];
        foreach($countries as $country){
            $new_load = $this->stagerepository->findCountryStages($country->getTitle());
            $itinerary[$country->getTitle()] = $new_load;
        }
        // Get the number of days of the journey so far
        $start_date = new DateTime('2018-8-31');
        $start_stamp = $start_date->getTimestamp();
        $today_date = new DateTime();
        $today_stamp = $today_date->getTimestamp();
        $how_many_seconds = $today_stamp-$start_stamp;
        $how_many_days = (int)($how_many_seconds/86400);


        return $this->render('pages/map.html.twig', [
            'itinerary' => $itinerary,
            'how_many_days' => $how_many_days
        ]);
    }

}

 ?>
