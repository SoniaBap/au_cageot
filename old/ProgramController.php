<?php

namespace App\Controller;

use App\Entity\Band;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\BandRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/program', name: 'app_program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        return $this->render('program/index.html.twig', [
            'programs' => $programRepository->findAll()
        ]);
    }




    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository, BandRepository $bandRepository, Band $band): Response
    {
        $program = new Program();
        $user = $this->getUser();
        $program->setUser($user);
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $programRepository->save($program, true);
            return $this->redirectToRoute('app_program_index');
        }
        return $this->render('program/new.html.twig', [
            'form' => $form->createView(),
          ]);
    } 

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Program $program, Request $request, ProgramRepository $programRepository): Response
    {
        $user = $this->getUser();
        $program->setUser($user);
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $programRepository->save($program, true);
            return $this->redirectToRoute('app_program_index');
        }
        return $this->render('program/edit.html.twig', [
            'form' => $form->createView()
          ]);
    }

    #[Route('delete/{id}', name: 'delete')]
    public function delete(Program $program, ProgramRepository $programRepository)
    {
        $programRepository->remove($program, true);
        return $this->redirectToRoute('app_program_delete');
    }
}
