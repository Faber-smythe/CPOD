<?php

namespace App\DataFixtures;

use App\Entity\Log;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LogFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        // for ($i = 0; $i<100; $i++) {
        //     $log = new Log;
        //     $log -> setTitle($faker->words(4, true));
        //     $log -> setTopic(1);
        //     $log -> setContent($faker->sentences(7, true));
        //     $manager->persist($log);
        // }
        // $manager->flush();
    }
}
