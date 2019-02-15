<?php

namespace App\Controller\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\StageType;
use App\Form\ShotType;
use App\Repository\StageRepository;
use App\Repository\ShotRepository;
use App\Repository\CountryRepository;
use App\Entity\Stage;
use App\Entity\Shot;
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
     * [shots_home description]
     * @Route("/admin/shots/index/{country?thailande}/{action?}", name="admin.shots")
     * @return Response [description]
     */
    public function shots_home($country, $action): Response
    {

        $stages = $this->stagerepository->findCountryStagesOldFirst($country);
        $parameters_to_render = [
            'action' => $action,
            'country' => $country,
            'countries' => $this->countryrepository->findAll(),
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
     * @Route("/admin/shots/new/{country}/{stage}", name="admin.shots.new")
     * @return Response [description]
     */
    public function shots_new($country, $stage, Request $request): Response
    {
        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepository->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }
        # STAGES CHOICEFIELD
        $stages = $this->stagerepository->findCountryStages($country);
        $stagechoices = [];
        foreach($stages as $entity){
            $stagechoices[$entity->getName()] = $entity->getName();
        }
        $shot = new Shot;

        $form = $this->createForm(ShotType::class, $shot, array(
            'countrychoices' => $countrychoices,
            'stagechoices' => $stagechoices,
            'fileindication' => "l'illustration est obligatoire",
            'requirefile' => true,
        ));
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($shot);
            $this->manager->flush();
            $this->addFlash('success', "Le shot a bien été ajouté à l'étape");
            return $this->redirectToRoute('admin.shots', [
                'country' => $shot->getCountry(),
                'action' => 'new',
            ]);
        }

        return $this->render('admin/shots/new.html.twig', [
            'shot' => $shot,
            'form' => $form->createView(),
            'country' => $country,
            'stage' => $stage
        ]);

    }


    /**
     * [shots_edit description]
     * @Route("/admin/shots/edit/{country}/{stage}/{id}", name="admin.shots.edit")
     * @return Response [description]
     */
    public function shots_edit(Shot $shot, Request $request, $country, $stage): Response
    {
        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepository->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }
        # STAGES CHOICEFIELD
        $stages = $this->stagerepository->findCountryStages($country);
        $stagechoices = [];
        foreach($stages as $entity){
            $stagechoices[$entity->getName()] = $entity->getName();
        }

        $form = $this->createForm(ShotType::class, $shot, array(
            'countrychoices' => $countrychoices,
            'stagechoices' => $stagechoices,
            'fileindication' => 'Illustration actuelle : ' . $shot->getFilename(),
            'requirefile' => false,
        ));
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($shot);
            $this->manager->flush();
            $this->addFlash('success', "Le shot a bien été modifié");
            return $this->redirectToRoute('admin.shots', [
                'country' => $shot->getCountry(),
                'action' => 'edit',
            ]);
        }

       return $this->render('admin/shots/edit.html.twig', [
           'form' => $form->createView(),
           'shot' => $shot,
           'country' => $country,
           'stage' => $stage

       ]);
    }



    /**
     * [shot_delete description]
     * @Route("/admin/shots/delete/{id}", name="admin.shots.delete", methods="DELETE")
     * @param  Shot      $shot     [description]
     * @return Response          [description]
     */
    public function shot_delete(Shot $shot, Request $request): Response
    {
       if($this->isCsrfTokenValid('delete' . $shot->getId(), $request->get('_token'))){
           $country_redirect = $shot->getCountry();
           $this->manager->remove($shot);
           $this->manager->flush();
           $this->addFlash('success', "La photo a été supprimée de l'étape");
       }
       return $this->redirectToRoute('admin.shots', [
           'country' => $country_redirect,
           'action' => 'delete'
       ]);
    }



    /**
     * [stage_new description]
     * @Route("/admin/shots/stages/new/{country}", name="admin.stage.new")
     * @return Response [description]
     */
    public function stage_new($country, Request $request): Response
    {
        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepository->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }
        $stage = new Stage;

        $form = $this->createForm(StageType::class, $stage, array(
            'countrychoices' => $countrychoices,
            'fileindication' => "l'arrière-plan est obligatoire."
        ));
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($stage);
            $this->manager->flush();
            $this->addFlash('success', "L'étape a bien été créée");
            return $this->redirectToRoute('admin.shots', [
                'country' => $stage->getCountry(),
                'action' => 'new',
            ]);
        }

        return $this->render('admin/stages/new.html.twig', [
            'stage' => $stage,
            'form' => $form->createView(),
            'country' => $country,
        ]);
    }

    /**
     * [stage_edit description]
     * @Route("/admin/shots/stages/edit/{country}/{id}-{previousname}", name="admin.stage.edit")
     * @return Response [description]
     */
    public function stage_edit(Stage $stage, Request $request, $country, $previousname): Response
    {
        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepository->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }

        $form = $this->createForm(StageType::class, $stage, array(
            'countrychoices' => $countrychoices,
            'fileindication' => "Arrière-plan actuel : " . $stage->getFilename()
        ));
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($stage);

            $shots_to_update = $this->shotrepository->findStageShots($previousname);
            foreach($shots_to_update as $shot){
                dump($shot->getStage());
                $shot->setStage($stage->getName());
                dump($shot->getStage());
                $this->manager->persist($shot);
            }

            $this->manager->flush();
            $this->addFlash('success', "L'étape a bien été modifiée");
            return $this->redirectToRoute('admin.shots', [
                'country' => $stage->getCountry(),
                'action' => 'edit',
            ]);
        }

       return $this->render('admin/stages/edit.html.twig', [
           'form' => $form->createView(),
           'country' => $country,
           'stage' => $stage

       ]);
    }

    /**
     * [stage_delete description]
     * @Route("/admin/shots/stages/delete/{id}", name="admin.stage.delete")
     * @return Response [description]
     */
    public function stage_delete(Stage $stage, Request $request): Response
    {
       if($this->isCsrfTokenValid('delete' . $stage->getId(), $request->get('_token'))){
           $country_redirect = $stage->getCountry();
           $shots_to_remove = $this->shotrepository->findStageShots($stage->getName());
           foreach($shots_to_remove as $shot){
               $this->manager->remove($shot);
           }
           $this->manager->remove($stage);
           $this->manager->flush();
           $this->addFlash('success', "L'étape ainsi que son contenu ont été supprimés");
       }
       return $this->redirectToRoute('admin.shots', [
           'country' => $country_redirect,
           'action' => 'delete'
       ]);
    }
}

 ?>
