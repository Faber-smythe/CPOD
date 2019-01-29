<?php

namespace App\Controller\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LogType;
use App\Repository\LogRepository;
use App\Repository\CountryRepository;
use App\Entity\Log;
use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class AdminPicturesController extends AbstractController
{


    public function __construct(CountryRepository $countryrepository, LogRepository $logrepository, ObjectManager $em)
    {
        $this->countryrepository = $countryrepository;
        $this->logrepository = $logrepository;
        $this->manager = $em;
    }

    /**
     * [galery_index description]
     * @Route("/admin/galery-index", name="admin.galery")
     * @return Response [description]
     */
    public function galery_index(): Response
    {
       return $this->render('admin/galery/index.html.twig');
    }

}

 ?>
