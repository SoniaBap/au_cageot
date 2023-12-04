<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    #[Route('/about-us', name: 'aboutUs')]
    public function aboutUs(): Response
    {
        return $this->render('page/about-us.html.twig', [
            'controller_name' => 'AboutUsController'
        ]);
    }
}
