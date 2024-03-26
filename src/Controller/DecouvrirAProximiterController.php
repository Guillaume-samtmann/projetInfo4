<?php

namespace App\Controller;

use App\Entity\DecouvrirAProximiter;
use App\Form\DecouvrirAProximiterType;
use App\Repository\DecouvrirAProximiterRepository;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/decouvrir/a/proximiter')]
class DecouvrirAProximiterController extends AbstractController
{
    #[Route('/', name: 'app_decouvrir_a_proximiter_index', methods: ['GET'])]
    public function index(DecouvrirAProximiterRepository $decouvrirAProximiterRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('decouvrir_a_proximiter/index.html.twig', [
            'decouvrir_a_proximiters' => $decouvrirAProximiterRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_decouvrir_a_proximiter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $decouvrirAProximiter = new DecouvrirAProximiter();
        $form = $this->createForm(DecouvrirAProximiterType::class, $decouvrirAProximiter);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($decouvrirAProximiter);
            $entityManager->flush();

            return $this->redirectToRoute('app_decouvrir_a_proximiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decouvrir_a_proximiter/new.html.twig', [
            'decouvrir_a_proximiter' => $decouvrirAProximiter,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_decouvrir_a_proximiter_show', methods: ['GET'])]
    public function show(DecouvrirAProximiter $decouvrirAProximiter, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('decouvrir_a_proximiter/show.html.twig', [
            'decouvrir_a_proximiter' => $decouvrirAProximiter,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_decouvrir_a_proximiter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DecouvrirAProximiter $decouvrirAProximiter, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(DecouvrirAProximiterType::class, $decouvrirAProximiter);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_decouvrir_a_proximiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decouvrir_a_proximiter/edit.html.twig', [
            'decouvrir_a_proximiter' => $decouvrirAProximiter,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_decouvrir_a_proximiter_delete', methods: ['POST'])]
    public function delete(Request $request, DecouvrirAProximiter $decouvrirAProximiter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decouvrirAProximiter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($decouvrirAProximiter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_decouvrir_a_proximiter_index', [], Response::HTTP_SEE_OTHER);
    }
}
