<?php

namespace App\Controller;

use App\Entity\MotCles;
use App\Form\MotClesType;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mot/cles')]
class MotClesController extends AbstractController
{
    #[Route('/', name: 'app_mot_cles_index', methods: ['GET'])]
    public function index(MotClesRepository $motClesRepository): Response
    {
        return $this->render('mot_cles/index.html.twig', [
            'mot_cles' => $motClesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mot_cles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $motCle = new MotCles();
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($motCle);
            $entityManager->flush();

            return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mot_cles/new.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mot_cles_show', methods: ['GET'])]
    public function show(MotCles $motCle): Response
    {
        return $this->render('mot_cles/showOne.html.twig', [
            'mot_cle' => $motCle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mot_cles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MotCles $motCle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mot_cles/edit.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mot_cles_delete', methods: ['POST'])]
    public function delete(Request $request, MotCles $motCle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motCle->getId(), $request->request->get('_token'))) {
            $entityManager->remove($motCle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
    }
}
