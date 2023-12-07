<?php

namespace App\Controller;

use App\Entity\Band;
use App\Entity\User;
use App\Form\BandType;
use App\Repository\BandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/band', name: 'app_band_')]
class BandController extends AbstractController
{
  #[Route('/', name: 'list')]
  public function index(BandRepository $bandRepository): Response
  {
    return $this->render('page/band/list.html.twig', [
      'bands' => $bandRepository->findAll()
    ]);
  }

  #[Route('/new', name: 'new')]
  public function new(Request $request, BandRepository $bandRepository): Response
  {
    $band = new Band();
    // $user = $this->getUser();
    // $band->setUser($user);
    $user = new User();
    $user->setEmail('milian@gmail.com');
    $user->setFirstname('Baptista');
    $user->setLastname('Milian');
    $band->setUser($user);
    $form = $this->createForm(BandType::class, $band);
    $form->handleRequest($request);
    //dd($form->getData());
    if ($form->isSubmitted() && $form->isValid()) {
      $picture = $form['picture']->getData();
      $form->getData();
      // $image = $request->files->get('picture');
      // $image = $band->getPicture();
      // Vérifiez si un fichier a été téléchargé
      if ($picture instanceof UploadedFile) {
        if ($picture == null) echo ("null");
        // else echo "pas null";
        // $uploadsDirectory = $this->getParameter('uploads/photos');
        $newFileName =  md5(uniqid()) . 'jpg';
        // Déplacez le fichier vers le répertoire de stockage
        $picture->move(
          'uploads/photos',
          $newFileName
        );
        $band->setPictureName($newFileName);
        // $band->setUser(12);
        // dd('pipi');
        $bandRepository->save($band, true);
        //dd('caca');
      }
      // else echo('pasupload');
      //    $bandRepository->save($band, true);


      //   return $this->redirectToRoute('app_band_index');    
    }

    //  else {

    //     echo("caca");
    //  }
    return $this->render('page/band/new.html.twig', [
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
    if ($form->isSubmitted() && $form->isValid()) {
      //  $picture = $form['picture']->getData();
      // dd($form['picture']->getData());
      $bandRepository->save($band, true);
      return $this->redirectToRoute('app_band_index');
    }
    return $this->render('band/edit.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/delete/{id}', name: 'delete')]

  public function delete(Band $band, BandRepository $bandRepository): Response
  {
    $bandRepository->remove($band, true);
    return $this->redirectToRoute('app_band_index');
  }
}
