<?php

namespace App\Services;

use Twig\Environment;

class VehiclesServices
{
    const DIR = 'snippets/';

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getRandomSpecifications()
    {       
        $arr = [
            'ABS',
            'Air Bags',
            'Bluetooth',
            'Car Kit',
            'GPS',
            'Music',
            'Wi-Fi',
            'Leather',
            'Metallic paint',
            'A/C',
        ];

        shuffle($arr);
        $index = rand(0, count($arr)-1);
        $randomArr = array_splice($arr, $index);

        return $this->twig->render(self::DIR . 'vehicules_spec.html.twig', [
            'specification' => $randomArr,
        ]);
    }
}