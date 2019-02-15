<?php

namespace App\Controller\Admin;

use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use App\Repository\CountryRepository;
use App\Repository\TagRepository;
use App\Entity\Picture;
use App\Entity\Country;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class AdminPicturesController extends AbstractController
{

    public function __construct(TagRepository $tagrepo, CountryRepository $countryrepo, PictureRepository $picturerepository, ObjectManager $em)
    {
        $this->picturerepository = $picturerepository;
        $this->tagrepo = $tagrepo;
        $this->countryrepo = $countryrepo;
        $this->manager = $em;
    }

    /**
     * [galery_index description]
     * @Route("/admin/galery/index{action?}", name="admin.galery")
     * @param  [type]   $action [description]
     * @return Response         [description]
     */
    public function galery_index(PaginatorInterface $paginator, Request $request, $action): Response
    {
        $pictures = $paginator->paginate(
            $this->picturerepository->allLatestFirst(),
            $request->query->getInt('page', 1),
            50
         );

        return $this->render('admin/galery/index.html.twig', [
           'pictures' => $pictures,
           'action' => $action
        ]);
    }

    /**
     * [galery_new description]
     * @Route("/admin/galery/new", name="admin.galery.new")
     * @param  [type]   $logtype [description]
     * @param  Request  $request [description]
     * @return Response          [description]
     */
    public function galery_new(Request $request ): Response
    {

        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepo->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }
        # TAGS CHOICEFIELD
        $tags = $this->tagrepo->findAll();
        $tagchoices = [];
        foreach($tags as $entity){
            $tagchoices[$entity->getTitle()] = $entity->getTitle();
        }
        $picture = new Picture;


        $form = $this->createForm(PictureType::class, $picture, array(
            'countrychoices' => $countrychoices,
            'tagchoices' => $tagchoices,
            'fileindication' => 'La photo est obligatoire',
            'requirefile' => true,
        ));
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($picture);
            $this->manager->flush();
            $this->addFlash('success', 'La photo a bien été ajoutée à la galerie');
            return $this->redirectToRoute('admin.galery', [
                'action' => 'new',
            ]);
        }
        return $this->render('admin/galery/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * [galery_edit description]
     * @Route("/admin/galery/edit/photo-{id}", name="admin.galery.edit")
     * @param  Picture  $picture [description]
     * @param  Request  $request [description]
     * @return Response          [description]
     */
     public function galery_edit(Picture $picture, Request $request ): Response
    {
        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepo->findAll();
        $countrychoices = [];
        foreach($countries as $entity){
            $countrychoices[$entity->getTitle()] = $entity->getTitle();
        }
        # TAGS CHOICEFIELD
        $tags = $this->tagrepo->findAll();
        $tagchoices = [];
        foreach($tags as $entity){
            $tagchoices[$entity->getTitle()] = $entity->getTitle();
        }

        $form = $this->createForm(PictureType::class, $picture, array(
            'countrychoices' => $countrychoices,
            'tagchoices' => $tagchoices,
            'fileindication' => "Photo actuelle : " . $picture->getFilename(),
            'requirefile' => false,
        ));
       $form -> handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {
           $this->manager->flush();
           $this->addFlash('success', 'La photo a été modifiée avec succès');
           return $this->redirectToRoute('admin.galery', [
               'action' => 'edit'
           ]);
       }

       return $this->render('admin/galery/edit.html.twig', [
           'form' => $form->createView(),
           'picture' => $picture
       ]);
    }
    /**
     * [journal_delete description]
     * @Route("/admin/galery/{id}-delete", name="admin.galery.delete", methods="DELETE")
     * @param  [type]   $logtype [description]
     * @param  Picture      $log     [description]
     * @param  Request  $request [description]
     * @return Response          [description]
     */
    public function journal_delete(Picture $picture, Request $request): Response
    {
       if($this->isCsrfTokenValid('delete' . $picture->getId(), $request->get('_token'))){
           $this->manager->remove($picture);
           $this->manager->flush();
           $this->addFlash('success', "La photo a été supprimée de la galerie");
       }
       return $this->redirectToRoute('admin.galery', [
           'action' => 'delete'
       ]);
    }
}

 ?>
