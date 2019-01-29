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

class AdminShotsController extends AbstractController
{


    public function __construct(CountryRepository $countryrepository, LogRepository $logrepository, ObjectManager $em)
    {
        $this->countryrepository = $countryrepository;
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
     * [countries_choice description]
     * @Route("/admin/countries", name="admin.countries")
     * @return Response [description]
     */
    public function countries_choice(): Response
    {
        $countries = $this->countryrepository->findAll();

       return $this->render('admin/countries/choice.html.twig', [
           'countries' => $countries
       ]);
    }
    /**
     * [countries_index description]
     * @Route("/admin/countries/{country}-index", name="admin.countries.index")
     * @return Response [description]
     */
    public function countries_index($country): Response
    {

        return $this->render('admin/countries/index.html.twig', [
            'country' => $country
        ]);
    }



}

 ?>
