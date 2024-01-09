<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FooterService;

class AboutUsController extends AbstractController
{
  #[Route('/about-us', name: 'aboutUs')]
  public function aboutUs(FooterService $footerService): Response
  {
    return $this->render('page/about-us.html.twig', [
      'controller_name' => 'AboutUsController',
      'footer' => $footerService->getVariables(),
      //'user' => mon_service->getUserInfo()['user'],
    ]);
  }
}
