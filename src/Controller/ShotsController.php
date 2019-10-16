<?php

namespace App\Controller;

use \DateTime;
use App\Repository\CountryRepository;
use App\Repository\StageRepository;
use App\Repository\ShotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ShotsController extends AbstractController
{
    public function __construct(ShotRepository $shotrepository, CountryRepository $countryrepository, StageRepository $stagerepository){

        $this->shotrepository = $shotrepository;
        $this->stagerepository = $stagerepository;
        $this->countryrepository = $countryrepository;
    }
    /**
     * [stage_choice description]
     * @Route("/pays/{country}", name="shots.choice")
     * @return Response [description]
     */
    public function stage_choice($country): Response
    {
        $stages = $this->stagerepository->findCountryStagesOldFirst($country);

        return $this->render('pages/shots/choice.html.twig', [
            'stages' => $stages,
            'country' => $country
        ]);
    }

    /**
     * [shots_content description]
     * @Route("/pays/{country}/{stage}", name="shots.content")
     * @return Response [description]
     */
    public function shots_content($country, $stage): Response
    {
        $stage = $this->stagerepository->findOneBy([
            'name' => $stage
        ]);
        $shots = $this->shotrepository->findStageShots($stage->getName());

        $laststage = $this->stagerepository->findPreviousCountryStage($stage->getCountry(), $stage->getId());
        $nextstage = $this->stagerepository->findNextCountryStage($stage->getCountry(), $stage->getId());

        dump($laststage);
        dump($nextstage);
        return $this->render('pages/shots/content.html.twig', [
            'stage' => $stage,
            'shots' => $shots,
            'country' => $country,
            'laststage' => $laststage,
            'nextstage' => $nextstage
        ]);
    }
}

 ?>
