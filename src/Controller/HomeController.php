<?php

namespace App\Controller;

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

        return $this->render('home/index.html.twig', [
            'HomePageForm' => $form->createView(),
        ]);
    }
}
