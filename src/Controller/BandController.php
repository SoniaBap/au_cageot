<?php

namespace App\Controller;

use App\Entity\Band;
use App\Repository\BandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/band', name: 'app_band_')]
class BandController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(BandRepository $bandRepository): Response
    {
        return $this->render('band/index.html.twig', [
            'bands' => $bandRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, BandRepository $bandRepository): Response
    {
        $band = new Band();
        $user = $this->getUser();
       // $band->setUserId($user);
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid())
           {
              $form->getData();
              $bandRepository->save($band, true);
               return $this->redirectToRoute('app_band_index');    
           }
        return $this->render('band/new.html.twig',[
              'form' => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Band $band, Request $request, BandRepository $bandRepository): Response
    {
        $user = $this->getUser();
        $band->setUser($user);
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid())
          {
              $form->getData();
              $bandRepository->save($band, true);
               return $this->redirectToRoute('app_band_index'); 
          }
        return $this->render('band/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name:'delete')]      

    public function delete(Band $band, BandRepository $bandRepository): Response
    {
        $bandRepository->remove($band, true);
        return $this->redirectToRoute('app_band_index');
    }
}