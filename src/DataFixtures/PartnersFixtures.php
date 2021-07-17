<?php

namespace App\DataFixtures;

use App\Entity\Partners;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class PartnersFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach ($this->setData() as $data) {
            $partners = new Partners();
            $partners->setName($data['title']);
            $partners->setImage($data['image']);
            $partners->setPosition($i);
            $partners->setStatus($data['status']);
            $manager->persist($partners);
            $i++;
        }

        $manager->flush();
    }

    private function setData()
    {
        return [
            [
                'title' => 'NAME #1',
                'image' => 'partner-logo-1.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #2',
                'image' => 'partner-logo-2.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #3',
                'image' => 'partner-logo-3.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #4',
                'image' => 'partner-logo-4.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #5',
                'image' => 'partner-logo-5.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #6',
                'image' => 'partner-logo-1.png',
                'status' => true,
            ],
            [
                'title' => 'NAME #7',
                'image' => 'partner-logo-4.png',
                'status' => true,
            ],
        ];
    }

    public static function getGroups(): array
    {
        return ['partners'];
    }
}
