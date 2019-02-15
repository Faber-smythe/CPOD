<?php

namespace App\Controller\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LogType;
use App\Repository\LogRepository;
use App\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class AdminLogsController extends AbstractController
{


    public function __construct(LogRepository $logrepository, ObjectManager $em)
    {
        $this->logrepository = $logrepository;
        $this->manager = $em;
    }

    /**
     * [admin_home description]
     * @Route("/admin", name="admin.home")
     * @return Response [description]
     */
    public function admin_home(): Response
    {
        return $this->render('admin/home.html.twig');
    }




    /**
     * [journal_choice description]
     * @Route("/admin/journal", name="admin.journal")
     * @return Response [description]
     */
    public function journal_choice(): Response
    {
       return $this->render('admin/journal/choice.html.twig');
    }
    /**
     * [journal_index description]
     * @Route("/admin/journal/{logtype}-logs{action?}", name="admin.journal.index")
     * @return Response [description]
     */
    public function journal_index($logtype, $action = ''): Response
    {
        if($logtype == 'travel'){
            $logs = $this->logrepository->findAllLogs(0);
        }
        elseif($logtype == 'dev') {
            $logs = $this->logrepository->findAllLogs(1);
        }
        return $this->render('admin/journal/index.html.twig', [
           'logs' => $logs,
           'logtype' => $logtype,
           'action' => $action
        ]);
    }

    /**
     * [journal_new description]
     * @Route("/admin/journal/{logtype}-logs/new", name="admin.journal.new")
     * @param  Log      $log     [description]
     * @param  Request  $request [description]
     * @return Response          [description]
     */
    public function journal_new($logtype, Request $request ): Response
    {
        $log = new Log;
        $form = $this->createForm(LogType::class, $log);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $logtype = Log::TOPIC['slug'][$log->topic];
            $this->manager->persist($log);
            $this->manager->flush();
            $this->addFlash('success', 'Entrée ajoutée au journal avec succès');
            return $this->redirectToRoute('admin.journal.index', [
                'action' => 'new',
                'logtype' => $logtype
            ]);
        }

        return $this->render('admin/journal/new.html.twig', [
            'logtype' => $logtype,
            'log' => $log,
            'form' => $form->createView(),
        ]);
    }

    /**
     * [journal_edit description]
     * @Route("/admin/journal/{logtype}-logs/edit-{id}", name="admin.journal.edit")
     * @param  Log      $log     [description]
     * @param  Request  $request [description]
     * @return Response          [description]
     */
    public function journal_edit(Log $log, $logtype, Request $request ): Response
    {
        if(empty($log->getFilename())){
            $fileindication = "";
        }else{
            $fileindication = "L'illustration actuelle est : " . $log->getFilename();
        }

        $form = $this->createForm(LogType::class, $log, array(
            'fileindication' => $fileindication
        ));
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            $this->addFlash('success', 'Journal modifié avec succès');
            return $this->redirectToRoute('admin.journal.index', [
                'logtype' => $logtype,
                'action' => 'edit',
                'fileindication' => $fileindication
            ]);
        }

        return $this->render('admin/journal/edit.html.twig', [
            'form' => $form->createView(),
            'log' => $log,
            'logtype' => $logtype
        ]);
    }

    /**
     * [journal_delete description]
     * @Route("/admin/journal/{logtype}-logs/{id}-delete", name="admin.journal.delete", methods="DELETE")
     * @param  [type]   $logtype [description]
     * @param  Log      $log     [description]
     * @return Response          [description]
     */
    public function journal_delete($logtype, Log $log, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete' . $log->getId(), $request->get('_token'))){
            $this->manager->remove($log);
            $this->manager->flush();
            $this->addFlash('success', "L'entrée a été supprimée du journal");
        }
        return $this->redirectToRoute('admin.journal.index', [
            'logtype' => $logtype,
            'action' => 'delete'
        ]);
    }
}

 ?>
