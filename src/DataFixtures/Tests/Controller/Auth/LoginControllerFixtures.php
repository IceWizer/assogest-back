<?php

namespace App\DataFixtures\Tests\Controller\Auth;

use App\DataFixtures\TestFixtures;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginControllerFixtures extends TestFixtures
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create 3 users
        // Super admin user
        // Admin user
        // User user

        $sup = new User();
        $password = $this->hasher->hashPassword($sup, 'Not24get');
        $sup->setUsername('superadmin');
        $sup->setEmail('superadmin@icewize.fr');
        $sup->setPassword($password);
        $sup->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($sup);

        $admin = new User();
        $password = $this->hasher->hashPassword($admin, 'Not24get');
        $admin->setUsername('admin');
        $admin->setEmail('admin@icewize.fr');
        $admin->setPassword($password);
        $admin->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($admin);

        $user = new User();
        $password = $this->hasher->hashPassword($user, 'Not24get');
        $user->setUsername('user');
        $user->setEmail('user@icewize.fr');
        $user->setPassword($password);
        $user->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($user);

        $manager->flush();
    }
}
