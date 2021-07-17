<?php

namespace App\DataFixtures;

use App\Entity\Testimonials;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class TestimonialsFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->setData() as $data) {
            $testimonials = new Testimonials();
            $testimonials->setName($data['title']);
            $testimonials->setDescription($data['description']);
            $testimonials->setImage($data['image']);
            $testimonials->setStatus($data['status']);
            $manager->persist($testimonials);
        }

        $manager->flush();
    }

    private function setData()
    {
        return [
            [
                'title' => 'Vongchong Smith',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.',
                'image' => 'client-pic-1.jpg',
                'status' => true,
            ],
            [
                'title' => 'Amader Tuni',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.',
                'image' => 'client-pic-3.jpg',
                'status' => true,
            ],
            [
                'title' => 'Atex Tuntuni Smith',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.',
                'image' => 'client-pic-2.jpg',
                'status' => true,
            ],
            [
                'title' => 'John Doe',
                'description' => '',
                'image' => '',
                'status' => false,
            ],
            [
                'title' => 'Alex Grey',
                'description' => '',
                'image' => '',
                'status' => false,
            ],
        ];
    }

    public static function getGroups(): array
    {
        return ['testimonials'];
    }
}
