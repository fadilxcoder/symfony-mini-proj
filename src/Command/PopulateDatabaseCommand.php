<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Vehicules;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateDatabaseCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:populate:db';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PopulateDatabaseCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Database population')

            // the full command description shown when running the command with the "--help" option
            ->setHelp('Populate database with Vehicles & Category')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
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
        for ($i = 0; $i < 10; $i++) {
            $vehicules = new Vehicules();
            $vehicules->setName($faker->name);
            $vehicules->setGearBox($gearBox[rand(0, 2)]);
            $vehicules->setPricePerDay($faker->randomNumber(2));
            $vehicules->setYear($faker->year($max = 'now'));
            $vehicules->setFuel($fuel[rand(0, 2)]);
            $vehicules->setType($type[rand(0, 2)]);
            $vehicules->setAdditionalDetails(
                'The Aventador LPER 720-4 50° ise a limited (200 units – 100 Coupe and 100 Roadster) versione of thed Aventadored LP 700-4 commemorating the 50th anniversary of Lamborghini. It included ised increased engine power to 720 PS (530 kW; 710 bhp) via a new specific engine calibration, enlarged and extended front air intakes and the aerodynamic splitter.'
            );
            $vehicules->setIsDisplayed($display[rand(0, 1)]);
            $vehicules->setCategory(null);
            $vehicules->setImage($images[rand(0, 5)]);
            $this->entityManager->persist($vehicules);
        }

        $categoriesArr = [
            'Small cars',
            'Family cars',
            'SUV cars',
            '6 seaters',
            'Vans',
            'Coasters',
        ];

        foreach ($categoriesArr as $key => $value) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $value);
            $categories =  new Category();
            $categories->setName($value);
            $categories->setSlug(strtolower($slug));
            $this->entityManager->persist($categories);
        }

        $this->entityManager->flush();

        $output->writeln([
            '',
            '----------------',
            'Tables vehicules / Category were populated !',
            '----------------',
            '',
        ]);

        return Command::SUCCESS;
        // return Command::FAILURE;
    }
}