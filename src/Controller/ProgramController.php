<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Service\FooterService;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/program', name: 'app_program_')]
class ProgramController extends AbstractController
{
	#[Route('/', name: 'list')]
	public function index(ProgramRepository $programRepository, FooterService $footerService): Response
	{
		return $this->render('page/program/program-list.html.twig', [
			'programs' => $programRepository->findAll(),
      'footer' => $footerService->getVariables(),
		]);
	}



	#[Route('/new', name: 'new')]
	public function new(Request $request, FooterService $footerService): Response
	{
		$program = new Program();
		$user = $this->getUser();
		$program->setUser($user);
		$form = $this->createForm(ProgramType::class, $program);
		$form->handleRequest($request);
		// if($form->isSubmitted() && $form->isValid())
		// {
		//     $form->getData();
		//     $programRepository->save($program, true);
		//     return $this->redirectToRoute('app_program_index');
		// }

		return $this->render('page/program/program-new.html.twig', [
			'form' => $form->createView(),
      'footer' => $footerService->getVariables(),
		]);
	}

	#[Route('/edit/{id}', name: 'edit')]
	public function edit(Program $program, Request $request, ProgramRepository $programRepository, FooterService $footerService): Response
	{
		$user = $this->getUser();
		$program->setUser($user);
		$form = $this->createForm(ProgramType::class, $program);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$form->getData();
			$programRepository->save($program, true);
			return $this->redirectToRoute('app_program_index');
		}
		return $this->render('page/program/program-edit.html.twig', [
			'form' => $form->createView(),
      'footer' => $footerService->getVariables(),
		]);
	}

	#[Route('delete/{id}', name: 'delete')]
	public function delete(Program $program, ProgramRepository $programRepository, FooterService $footerService)
	{
		$programRepository->remove($program, true);
		return $this->redirectToRoute('app_program_delete');
	}
}
