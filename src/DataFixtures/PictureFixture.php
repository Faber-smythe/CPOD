<?php

namespace App\DataFixtures;

use App\Repository\CountryRepository;
use App\Repository\TagRepository;
use Faker\Factory;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixture extends Fixture
{
    public function __construct(CountryRepository $countryrepo, TagRepository $tagrepo){
        $this->countryrepo = $countryrepo;
        $this->tagrepo = $tagrepo;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        # COUNTRIES CHOICEFIELD
        $countries = $this->countryrepo->findAll();
        $countrylist = [];
        foreach($countries as $entity){
            $countrylist[$entity->getTitle()] = $entity->getTitle();
        }
        # TAGS CHOICEFIELD
        $tags = $this->tagrepo->findAll();
        $taglist = [];
        foreach($tags as $entity){
            $taglist[$entity->getTitle()] = $entity->getTitle();
        }


        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
