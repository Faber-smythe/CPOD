<?php

namespace App\Controller\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StageRepository;
use App\Repository\ShotRepository;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class AdminShotsController extends AbstractController
{


    public function __construct(CountryRepository $countryrepository, ShotRepository $shotrepository, StageRepository $stagerepository, ObjectManager $em)
    {
        $this->stagerepository = $stagerepository;
        $this->shotrepository = $shotrepository;
        $this->countryrepository = $countryrepository;
        $this->manager = $em;

    }

    /**
     * [admin_home description]
     * @Route("/admin/shots/{country?thailande}", name="admin.shots")
     * @return Response [description]
     */
    public function shots_home($country): Response
    {

        $stages = $this->stagerepository->findCountryStages($country);
        $parameters_to_render = [
            'country' => $country,
            'stages' => $stages,
            'shots' => []
        ];

        foreach($stages as $stage){
            $new_load = $this->shotrepository->findStageShots($stage->getName());
            array_unshift($new_load, $stage); /* we add the name of the load/stage for the first loop */
            $parameters_to_render['shots'][] = $new_load; /* one new load means one new stage */
        }

        return $this->render('admin/shots/index.html.twig', $parameters_to_render);
    }

    /**
     * [shots_new description]
     * @Route("/admin/shots/new-{country}-{stage}-shot", name="admin.shots.new")
     * @return Response [description]
     */
    public function shots_new($country, $stage): Response
    {}


    /**
     * [shots_edit description]
     * @Route("/admin/shots/edit-{country}-{stage}-shot/{id}", name="admin.shots.edit")
     * @return Response [description]
     */
    public function shots_edit($country): Response
    {}


    /**
     * [shots_delete description]
     * @Route("/admin/shots/delete-{id}", name="admin.shots.delete")
     * @return Response [description]
     */
    public function shots_delete($id): Response
    {}



    /**
     * [stage_new description]
     * @Route("/admin/shots/new-stage", name="admin.stage.new")
     * @return Response [description]
     */
    public function stage_new($country): Response
    {}

    /**
     * [stage_edit description]
     * @Route("/admin/shots/edit-{country}-stage/{stage}", name="admin.stage.edit")
     * @return Response [description]
     */
    public function stage_edit($stage): Response
    {}

    /**
     * [stage_delete description]
     * @Route("/admin/shots/delete-stage/{id}", name="admin.stage.delete")
     * @return Response [description]
     */
    public function stage_delete($id): Response
    {}
}

 ?>
