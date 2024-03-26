<?php

namespace App\Controller;

use App\Entity\DecouvrirSurPlace;
use App\Form\DecouvrirSurPlaceType;
use App\Repository\DecouvrirSurPlaceRepository;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/decouvrir/sur/place')]
class DecouvrirSurPlaceController extends AbstractController
{
    #[Route('/', name: 'app_decouvrir_sur_place_index', methods: ['GET'])]
    public function index(DecouvrirSurPlaceRepository $decouvrirSurPlaceRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('decouvrir_sur_place/index.html.twig', [
            'decouvrir_sur_places' => $decouvrirSurPlaceRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_decouvrir_sur_place_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $decouvrirSurPlace = new DecouvrirSurPlace();
        $form = $this->createForm(DecouvrirSurPlaceType::class, $decouvrirSurPlace);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($decouvrirSurPlace);
            $entityManager->flush();

            return $this->redirectToRoute('app_decouvrir_sur_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decouvrir_sur_place/new.html.twig', [
            'decouvrir_sur_place' => $decouvrirSurPlace,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_decouvrir_sur_place_show', methods: ['GET'])]
    public function show(DecouvrirSurPlace $decouvrirSurPlace, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('decouvrir_sur_place/show.html.twig', [
            'decouvrir_sur_place' => $decouvrirSurPlace,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_decouvrir_sur_place_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DecouvrirSurPlace $decouvrirSurPlace, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(DecouvrirSurPlaceType::class, $decouvrirSurPlace);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_decouvrir_sur_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decouvrir_sur_place/edit.html.twig', [
            'decouvrir_sur_place' => $decouvrirSurPlace,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_decouvrir_sur_place_delete', methods: ['POST'])]
    public function delete(Request $request, DecouvrirSurPlace $decouvrirSurPlace, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decouvrirSurPlace->getId(), $request->request->get('_token'))) {
            $entityManager->remove($decouvrirSurPlace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_decouvrir_sur_place_index', [], Response::HTTP_SEE_OTHER);
    }
}
