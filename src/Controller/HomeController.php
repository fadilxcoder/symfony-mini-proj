<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Partners;
use App\Entity\PricingBlock;
use App\Entity\Testimonials;
use App\Entity\Vehicules;
use App\Form\HomePageSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * HomeController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $form = $this->createForm(HomePageSearchType::class);
        $em = $this->getDoctrine()->getManager();

        return $this->render('home/index.html.twig', [
            'getBlockPricingDetails' => $em->getRepository(PricingBlock::class)->getBlockPricingDetails(true),
            'getTestimonialsDetails' => $em->getRepository(Testimonials::class)->getTestimonials(),
            'partners' => $em->getRepository(Partners::class)->getPartners(),
            'HomePageForm' => $form->createView(),
        ]);
    }

    public function _newsletterForm($yr)
    {
        return $this->render('sub-request/_newsletter.html.twig', [
            'headerText' => 'Newsletter '.$yr,
            'phraseText' => 'Lorem ipsum dolored is a sit ameted consectetur adipisicing elit',
        ]);
    }

    /**
     * @Route("/populate-database", name="db_population")
     */
    public function populateDb()
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

        return new JsonResponse([
            'HTTP' => 'OK',
        ]);
    }
}
