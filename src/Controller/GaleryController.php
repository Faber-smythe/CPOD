<?php

namespace App\Controller;

use App\Form\PictureSearchType;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use App\Repository\CountryRepository;
use App\Repository\TagRepository;
use App\Entity\Picture;
use App\Entity\Country;
use App\Entity\PictureSearch;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class GaleryController extends AbstractController
{

    public function __construct(TagRepository $tagrepo, CountryRepository $countryrepo, PictureRepository $picturerepository, ObjectManager $em)
    {
        $this->picturerepository = $picturerepository;
        $this->tagrepo = $tagrepo;
        $this->countryrepo = $countryrepo;
        $this->manager = $em;
    }


    /**
     * [journal_content description]
     * @Route("/fais-voir", name="galery")
     * @return Response [description]
     */
    public function galery_content(PaginatorInterface $paginator, Request $request): Response
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

        $search = new PictureSearch();
        $form = $this->createForm(PictureSearchType::class, $search, array(
            'countrychoices' => $countrychoices,
            'tagchoices' => $tagchoices,
        ));
        $form->handleRequest($request);


        $pictures = $paginator->paginate(
            $this->picturerepository->allRecentFirst($search),
            $request->query->getInt('page', 1),
            60
         );

        return $this->render('pages/galery.html.twig', array(
            'pictures' => $pictures,
            'form' => $form->createView()
        ));
    }

}

 ?>
