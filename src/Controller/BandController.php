<?php

namespace App\Controller;

use App\Entity\Band;
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
        //$user = $this->getUser();
        //$band->setUser($user);
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);
        //dd($form->getData());
       // echo('coucou');
              if($form->isSubmitted() && $form->isValid())
              {
                $picture = $form['picture']->getData();

                // echo('coucou');
                  $form->getData();
                 // $image = $request->files->get('picture');
                // $image = $band->getPicture();
              //  echo ($image);
                // echo('submitted');
              // Vérifiez si un fichier a été téléchargé
                 if  ($picture instanceof UploadedFile) 
                 {
                    if($picture == null) echo("null");
                    // else echo "pas null";
                 // $uploadsDirectory = $this->getParameter('uploads/photos');
                 $newFileName = 'Tadaronne.jpg';
                //    echo($newFileName) ;
                  // Déplacez le fichier vers le répertoire de stockage
                  
                  $picture->move(
                  'uploads/photos',
                  'photos.jpg'
                  );    
                  $band->setPicture($newFileName);

                }



                    // else echo('pasupload');
               //    $bandRepository->save($band, true);

                   
            //   return $this->redirectToRoute('app_band_index');    
                 }

                //  else {

                //     echo("caca");
                //  }
                

                 
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
