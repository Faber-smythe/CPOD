<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/journal/index/{topic?voyage}", name="journal.index")
     * @return Response [description]
     */
    public function journal_index(PaginatorInterface $paginator, Request $request, $topic): Response
    {
        if($topic == 'voyage') {
            $last_log = $this->repository->findLastLog(0);
            $logs = $paginator->paginate(
                $this->repository->findOlderLogs(0),
                $request->query->getInt('page', 1),
                6
             );
        }
        if($topic == 'developpement') {
            $last_log = $this->repository->findLastLog(1);
            $logs = $paginator->paginate(
                $this->repository->findOlderLogs(1),
                $request->query->getInt('page', 1),
                6
             );
        }
        return $this->render('pages/journal/index.html.twig', [
            'last_log' => $last_log,
            'logs' => $logs,
            'topic' => $topic
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
