<?php

  namespace App\Controller;

  use App\Entity\User;
  use App\Form\RegistrationType;
  use App\Repository\UserRepository;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


  // #[Route('/security', name: 'app_security_')]

  class SecurityController extends AbstractController
  {
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
      $error = $authenticationUtils->getLastAuthenticationError();
      $lastUsername = $authenticationUtils->getLastUsername();
      return $this->render('page/login.html.twig', [
        'last_username' => $lastUsername,
        'error' => $error,
      ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
          // nothing to put inside because symfony do that
    }

    #[Route('/register', name: 'register')]
    public function registration(Request $request, UserRepository $userRepository)
    {
      $user = new User();
      $user->setRoles(['ROLE_USER']);
      $form = $this->createForm(RegistrationType::class, $user);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $form->getData();
        $userRepository->save($user, true);
        return $this->redirectToRoute('login');
      }
      return $this->render('page/register.html.twig',[
        'form'=> $form->createView()
      ]);
    }
  }
