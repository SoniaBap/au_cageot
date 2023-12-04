<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermsAndConditionsController extends AbstractController
{
    #[Route('/terms-and-conditions', name: 'termsAndConditions')]
    public function termsAndConditions(): Response
    {
        return $this->render('page/terms-and-conditions.html.twig', [
            'controller_name' => 'TermsAndConditionsController'
        ]);
    }
}
