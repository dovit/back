<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('test');
        $userAdmin->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);

        $user = new User();
        $user->setUsername('user');
        $user->setPassword('test');
        $user->setRoles(['ROLE_CLIENT']);

        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setPassword('test');
        $user1->setRoles(['ROLE_CLIENT']);

        $manager->persist($user1);
        $manager->flush();
    }
}
