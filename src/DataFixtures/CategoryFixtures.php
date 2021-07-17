<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->setData() as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function setData()
    {
        return [
            [
                'name' => 'Small cars',
            ],
            [
                'name' => 'Family cars',
            ],
            [
                'name' => 'SUV cars',
            ],
            [
                'name' => '6 seaters',
            ],
            [
                'name' => 'Vans',
            ],
            [
                'name' => 'Coasters',
            ]
        ];
    }

    public static function getGroups(): array
    {
        return ['app-categories'];
    }
}
