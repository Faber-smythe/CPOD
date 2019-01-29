<?php

namespace App\Controller;

use App\Repository\LogRepository;
use App\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class JournalController extends AbstractController
{

    public function __construct(LogRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * [journal_index description]
     * @Route("/journal", name="journal.index")
     * @return Response [description]
     */
    public function journal_index(): Response
    {

        // $log = new Log();
        // $log -> setTitle('Premier billet de voyage !')
        //     -> setTopic(0)
        //     -> setContent("Petit point sur notre étape actuelle.
        //         Nous avons donc passé une semaine à Bangkok, puis une semaine à Koh Lanta. Nous somme donc maintenant à Chiang Mai, au milieu de notre troisième et dernière étape. On rembobine la semaine :
        //
        //         On a découvert la vieille ville, dont les vestiges sont étonnants ; elle est absolument carrée, entourée d'un canal (sans doute les anciennes douves) et d'immenses pans de muraille.
        //
        //         On a découvert les marchés de nuit d'ici, qui s'étalent sur des kilomètres. Il y en a plusieurs (dont le fameux Night Bazaar) qui sont ouverts toutes les nuits, plus deux grands qui n'ouvrent que le week-end. Mais même en dehors de ces endroits, rien ne vous empêche d'aller vous chercher une brochette à deux heures du matin si vous avez un petit creux.
        //
        //         On a assisté à des combats de boxe thaï : Il y a beaucoup d'affiches qui font la publicité des différents stades de Chiang Mai, et il parait qu'il y a des pièges à touristes à éviter. De notre côté, on était devant un petit ring local, où il y avait autant de locaux que de Farangs (les étrangers). Les combattants et les combattantes faisaient 50 à 60 kilos, et se donnaient du mal (un KO sur cinq combats). Ici, seul le vainqueur est rémunéré...
        //
        //         On a essayé le massage thaï. On peut lire des anecdotes assez terrifiantes sur des gens qui se réveillent le lendemain avec des bleus. Ça n'est pas tout à fait exagéré. Clairement, les muscles sont massés, mais pas que. Au programme, assouplissements et étirements vigoureux, utilisation des coudes, des genoux, des pieds (de la masseuse !), points névralgiques copieusement enfoncés, articulations bien éprouvées... Aucun risque de s'endormir pendant le traitement. La détente ne vient pas pendant, mais après, bel et bien. Retours mitigés de la part d'Ariane et moi, donc, mais expérience intéressante !");
        //
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($log);
        // $em->flush();

        $last_travel_log = $this->repository->findLastLog(0);
        $travel_logs = $this->repository->findOlderLogs(0);

        $last_dev_log = $this->repository->findLastLog(1);
        $dev_logs = $this->repository->findOlderLogs(1);

        return $this->render('pages/journal/index.html.twig', [
            'last_travel_log' => $last_travel_log,
            'last_dev_log' => $last_dev_log,
            'travel_logs' => $travel_logs,
            'dev_logs' => $dev_logs
        ]);

    }

    /**
     * [journal_show description]
     * @Route("/journal/{id}-{slug}", name="journal.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response [description]
     */
    public function journal_show($slug, $id): Response
    {

        $log = $this->repository->find($id);

        return $this->render('pages/journal/show.html.twig', [
            'log' => $log
        ]);

    }
}

 ?>
