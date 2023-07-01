<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



#[Route('/user', name: 'app_user_')]
class UserController extends AbstractController
{
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_security_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user_edit');
        }
            $form = $this->createForm(UserType::class, $user);
            $form->HandleRequest($request);
            

               if($form->isSubmitted() && $form->isValid())
                {

                  if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword()))
                     {    
                       $form->getData();
                       $userRepository->save($user, true);    
                       $this->addFlash(
                       'success',
                       'Votre compte a bien été modifié');
                         
                       return $this->RedirectToRoute('app_security_login');

                     }

                  else
                    {
                         $this->addFlash(
                        'error',
                        "Votre compte n'est pas modifié");
                    }
                }
                    return $this->render('user/edit.html.twig', [
                        'form'=> $form->createView(),
                    ]);
}


    #[Route('/edit/password/{id}', name: 'edit_password')]
    public function editPassword(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_security_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user_edit');
        }

        $form = $this->createForm(UserPasswordType::class);
        $form->HandleRequest($request);
            
        if($form->isSubmitted() && $form->isValid())
         {

           if ($hasher->isPasswordValid($user, $form->getData()['plainPassword']))
              {    
                $user->setPassword($hasher->hashPassword($user, $form->getData()['newPassword']));
                $userRepository->save($user, true);    
                $this->addFlash(
                'success',
                'Votre mot de passe a bien été modifié');
                  
                return $this->RedirectToRoute('app_security_login');

              }
           else
             {
                  $this->addFlash(
                 'error',
                 "Votre mot de passe n'est pas modifié");
             }
         }
             return $this->render('user/edit_password.html.twig', [
                 'form'=> $form->createView(),
             ]);
}
    }


