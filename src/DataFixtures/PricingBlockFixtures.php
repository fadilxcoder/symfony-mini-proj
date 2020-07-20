<?php

namespace App\DataFixtures;

use App\Entity\PricingBlock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PricingBlockFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->setData() as $data) {
            $pricingBlock = new PricingBlock();
            $pricingBlock->setTitle($data['title']);
            $pricingBlock->setDescription($data['description']);
            $pricingBlock->setPrice($data['price']);
            $pricingBlock->setType($data['type']);
            $pricingBlock->setStatus($data['status']);
            $pricingBlock->setPosition($data['position']);
            $manager->persist($pricingBlock);
        }

        $manager->flush();
    }

    private function setData()
    {
        return [
            [
                'title' => 'BUSINESS',
                'description' => '<ul class="package-list"><li>FREE VEHICLE DELIVERY</li><li>WEDDINGS CELEBRATIONS</li><li>FULL INSURANCE INCLUDED</li><li>TRANSPORT ABROAD</li><li>ALL INCLUSIVE MINI BAR</li><li>CHAUFFER INCLUDED IN PRICE</li></ul>',
                'price' => 55,
                'status' => true,
                'position' => 1,
                'type' => 'PER MONTH',
            ],
            [
                'title' => 'TRIAL',
                'description' => '<ul class="package-list"><li>FREE VEHICLE DELIVERY</li><li>OTHER CELEBRATIONS</li><li>FULL INSURANCE</li><li>TRANSPORT ABROAD</li><li>MINI BAR</li><li>INCLUDED IN PRICE</li></ul>',
                'price' => 0,
                'status' => true,
                'position' => 1,
                'type' => 'PER MONTH',
            ],
            [
                'title' => 'STANDARD',
                'description' => '<ul class="package-list"><li>DELIVERY AT AIRPORT</li><li>WEDDINGS AND OTHER</li><li>FULL INCLUDED</li><li>TRANSPORT ABROAD</li><li>ALL MINI BAR</li><li>CHAUFFER PRICE</li></ul>',
                'price' => 35,
                'status' => true,
                'position' => 1,
                'type' => 'PER MONTH',
            ],
            [
                'title' => 'EXECUTIVE',
                'description' => '',
                'price' => 0,
                'status' => false,
                'position' => 1,
                'type' => 'PER DAY',
            ],
        ];
    }

    public static function getGroups(): array
    {
        return ['pricing-block'];
    }
}
