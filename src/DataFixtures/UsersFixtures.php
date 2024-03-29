<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use PhpParser\Node\Stmt\Const_;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture implements FixtureGroupInterface
{
    private const ROW = 10;

    private const PASSWD = 'admin123';

    public function __construct()
    {
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->setData() as $data) {
            $user = new User();

            $user->setEmail($data['email'])
                ->setRoles($data['roles'])
                ->setFirstName($data['first_name'])
                ->setLastName($data['last_name'])
                ->setPlainPassword($data['password'])
                ->setIsActive($data['is_active'])
                ->setToken($data['token'])
                ->setIsRgpdAccepted($data['is_rgpd_accepted'])
                ->setRgpdAcceptedAt($data['rgpd_accepted_at'])
                ->setLastLoginAt($data['last_login_at'])
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }


    private function setData()
    {
        $faker = Factory::create();
        $response = [];

        for ($i = 0; $i < self::ROW; $i++) {
            $gender = $faker->randomElement(['male', 'female']);

            $response[] = [
                'email' => $faker->email,
                'roles' => $faker->randomElement([['ROLE_USER'], ['ROLE_SUPPORT'], ['ROLE_ADMIN']]),
                'password' => self::PASSWD,
                'first_name' => $faker->firstName($gender),
                'last_name' => $faker->lastName(),
                'is_active' => $faker->randomElement([true, false]),
                'token' => null,
                'is_rgpd_accepted' => false,
                'rgpd_accepted_at' => null,
                'last_login_at' => null,
            ];
        }

        return $response;
    }


    public static function getGroups(): array
    {
        return ['users'];
    }
}
