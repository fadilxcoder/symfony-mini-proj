<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Partners;
use App\Entity\PricingBlock;
use App\Entity\Testimonials;
use App\Form\HomePageSearchType;
use Doctrine\ORM\EntityManagerInterface;
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
        $em = $this->entityManager; // $em = $this->getDoctrine()->getManager();
        $getBlockPricingDetails = $em->getRepository(PricingBlock::class)->getBlockPricingDetails(true);
        $getTestimonialsDetails = $em->getRepository(Testimonials::class)->getTestimonials();
        $partners = $em->getRepository(Partners::class)->getPartners();

        return $this->render('home/index.html.twig', [
            'getBlockPricingDetails' => $getBlockPricingDetails,
            'getTestimonialsDetails' => $getTestimonialsDetails,
            'partners' => $partners,
            'HomePageForm' => $form->createView(),
        ]);
    }

    public function _newsletterForm($yr)
    {
        return $this->render('sub-request/_newsletter.html.twig', [
            'headerText' => 'Newsletter ' . $yr,
            'phraseText' => 'Lorem ipsum dolored is a sit ameted consectetur adipisicing elit',
        ]);
    }
}
