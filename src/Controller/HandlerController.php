<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HandlerController extends AbstractController
{
    private $em;
    private $objectManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->em = $entityManager;
    }

    /**
     * @Route("/newsletter-subscription", name="newsletterSubscribe", options={"expose"=true})
     */
    public function subscribeToNewsletter(Request $request, ValidatorInterface $validator)
    {
        $response = [];
        if ($request->isXmlHttpRequest()) {
            $newsletter = new Newsletter();
            $newsletter->setEmail($request->request->get('newsletterEmail'));
            $newsletter->setLogged(new \DateTime('now'));
            $errors = $validator->validate($newsletter);

            $string = '';

            if (count($errors) > 0) {
                foreach ($errors as $_err) {
                    $string .= '<div class="alert alert-danger" role="alert">'.$_err->getMessage().'</div>';
                }
            } else {
                $this->em->persist($newsletter);
                $this->em->flush();
                $string .= '<div class="alert alert-success" role="alert">Thank you for subscribing.</div>';
            }

            $response = ['msg' => $string];
        }

        return $this->json([
            'response' => $response,
        ]);
    }
}
