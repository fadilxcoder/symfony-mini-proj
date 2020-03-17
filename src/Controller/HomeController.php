<?php

namespace App\Controller;

use App\Entity\Partners;
use App\Entity\PricingBlock;
use App\Entity\Testimonials;
use App\Form\HomePageSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
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
}
