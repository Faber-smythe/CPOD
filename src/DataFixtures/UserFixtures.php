<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use\App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        /// ** COMMENTED TO AVOID CREATING CLONES
        // $user = new User();
        // $user->setUsername('Faber');
        // $user->setPassword($this->encoder->encodePassword($user, '@dm1n1str@teur'));
        // $manager->persist($user);
        // $manager->flush();
    }
}
