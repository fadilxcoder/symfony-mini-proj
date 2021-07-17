<?php

namespace App\DataFixtures;

use App\Entity\Vehicules;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Repository\CategoryRepository;

class VehiclesFixtures extends Fixture implements FixtureGroupInterface
{
    private const ROW = 100;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->setData() as $data) {
            $vehicules = new Vehicules();
            $vehicules->setName($data['name']);
            $vehicules->setGearBox($data['gear_box']);
            $vehicules->setPricePerDay($data['price_per_day']);
            $vehicules->setYear($data['year']);
            $vehicules->setFuel($data['fuel']);
            $vehicules->setType($data['type']);
            $vehicules->setAdditionalDetails($data['additional_details']);
            $vehicules->setIsDisplayed($data['is_displayed']);
            $vehicules->setCategory($data['category']);
            $vehicules->setImage($data['image']);
            $manager->persist($vehicules);
        }

        $manager->flush();
    }


    private function setData()
    {
        $faker = Factory::create();

        $gearBox = [
            'Manual',
            'Automatic',
            'Septronic',
        ];

        $fuel = [
            'Petrol',
            'Diesel',
            'Electric',
        ];

        $type = [
            'Compact',
            'Sport',
            'Luxury',
        ];

        $display = [
            true,
            false,
        ];

        $images = [
            'car-1.jpg',
            'car-2.jpg',
            'car-3.jpg',
            'car-4.jpg',
            'car-5.jpg',
            'car-6.jpg',
        ];

        $response = [];
        for ($i = 0; $i < self::ROW; $i++) {
            $response[] = [
                'name' => $faker->name,
                'gear_box' => $gearBox[rand(0, 2)],
                'price_per_day' => $faker->randomNumber(2),
                'year' => $faker->year($max = 'now'),
                'type' => $type[rand(0, 2)],
                'additional_details' => 'The Aventador LPER 720-4 50° ise a limited (200 units – 100 Coupe and 100 Roadster) versione of thed Aventadored LP 700-4 commemorating the 50th anniversary of Lamborghini. It included ised increased engine power to 720 PS (530 kW; 710 bhp) via a new specific engine calibration, enlarged and extended front air intakes and the aerodynamic splitter.',
                'is_displayed' => $display[rand(0, 1)],
                'fuel' => $fuel[rand(0, 2)],
                'image' => $images[rand(0, 5)],
                'category' => $this->getRandomCategory(),
            ];
        }

        return $response;
    }

    private function getRandomCategory()
    {
        $cats = $this->categoryRepository->findAll();
        shuffle($cats);
        $oneCategory = $cats[0];

        return $oneCategory;
    }


    public static function getGroups(): array
    {
        return ['random-vehicules'];
    }
}
