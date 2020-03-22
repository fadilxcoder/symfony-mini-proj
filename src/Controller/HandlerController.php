<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HandlerController extends AbstractController
{
    /**
     * @Route("/newsletter-subscription", name="newsletterSubscribe")
     */
    public function subscribeToNewsletter()
    {

    }
}
