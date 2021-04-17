<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Partners;
use App\Entity\PricingBlock;
use App\Entity\Testimonials;
use App\Form\HomePageSearchType;
use App\Mailer\AuthMailer;
use App\Repository\VehiculesRepository;
use String\Normalizer\StringNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    const CACHE_TIME = 60;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var VehiculesRepository
     */
    private $vehiculesRepository;

    /**
     * @var CacheInterface
     */
    private $cacheInterface;

    /**
     * HomeController constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param VehiculesRepository    $vehiculesRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        VehiculesRepository $vehiculesRepository,
        CacheInterface $cacheInterface,
        StringNormalizer $stringNormalizer
    ) {
        $this->entityManager = $entityManager;
        $this->vehiculesRepository = $vehiculesRepository;
        $this->cacheInterface = $cacheInterface;
        $this->stringNormalizer = $stringNormalizer;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $form = $this->createForm(HomePageSearchType::class);
        $em = $this->entityManager; // $em = $this->getDoctrine()->getManager();

        // $getBlockPricingDetails = $em->getRepository(PricingBlock::class)->getBlockPricingDetails(true);
        $getBlockPricingDetails = $this->cacheInterface->get('hp.pricing.details', function(ItemInterface $item) use ($em) {
            $item->expiresAfter(self::CACHE_TIME);
            return $em->getRepository(PricingBlock::class)->getBlockPricingDetails(true);
        });

        // $getTestimonialsDetails = $em->getRepository(Testimonials::class)->getTestimonials();
        $getTestimonialsDetails = $this->cacheInterface->get('hp.testimonial.details', function(ItemInterface $item) use ($em) {
            $item->expiresAfter(self::CACHE_TIME);
            return $em->getRepository(Testimonials::class)->getTestimonials();
        });

        // $partners = $em->getRepository(Partners::class)->getPartners();
        $partners = $this->cacheInterface->get('hp.partners', function(ItemInterface $item) use ($em) {
            $item->expiresAfter(self::CACHE_TIME);
            return $em->getRepository(Partners::class)->getPartners();
        });

        // $vehicles = $this->vehiculesRepository->selectRandom();
        $vehicles = $this->cacheInterface->get('hp.vehicles', function(ItemInterface $item){
            $item->expiresAfter(self::CACHE_TIME);
            return $this->vehiculesRepository->selectRandom();
        });

        return $this->render('home/index.html.twig', [
            'getBlockPricingDetails' => $getBlockPricingDetails,
            'getTestimonialsDetails' => $getTestimonialsDetails,
            'partners' => $partners,
            'HomePageForm' => $form->createView(),
            'vehicules' => $vehicles,
            'stringNrmlz' => $this->theNormalizer(),
        ]);
    }

    public function theNormalizer()
    {
        $str = 'Nadine et Charles se sont rencontrés par hasard sur les Champs-Élysées. Ils sont amis depuis longtemps.À Montréal, ils fréquentaient les mêmes endroits, ils allaient régulièrement prendre un verre ou dîner dans la rue Sainte-Sophie.';

        return $this->stringNormalizer->convert($str);
    }

    public function _newsletterForm($yr)
    {
        return $this->render('sub-request/_newsletter.html.twig', [
            'headerText' => 'Newsletter ' . $yr,
            'phraseText' => 'Lorem ipsum dolored is a sit ameted consectetur adipisicing elit',
        ]);
    }
}
