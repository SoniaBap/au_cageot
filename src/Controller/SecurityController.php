<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Service\FooterService;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

//#[Route('/security', name: 'app_security_')]

class SecurityController extends AbstractController
{
  #[Route('/login', name: 'app_security_login')]
  public function login(AuthenticationUtils $authenticationUtils, FooterService $footerService): Response
  {
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('page/user/user-login.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error,
      'footer' => $footerService->getVariables(),
    ]);
  }

  #[Route('/logout', name: 'app_security_logout')]
  public function logout()
  {
    // nothing to put inside because symfony do that
  }

  #[Route('/register', name: 'app_security_register')]
  public function userRegister(Request $request, UserRepository $userRepository, FooterService $footerService)
  {
    $user = new User();
    $user->setRoles(['ROLE_USER']);
    $form = $this->createForm(UserRegisterType::class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $user = $form->getData();
      $userRepository->save($user, true);
      return $this->redirectToRoute('app_security_login');
    }

    return $this->render('page/user/user-register.html.twig', [
      'form' => $form->createView(),
      'footer' => $footerService->getVariables(),
      //'form' => $form,
    ]);
  }
}
