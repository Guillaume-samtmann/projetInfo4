<?php

namespace App\Controller;

use App\Entity\InformationsAnnimaux;
use App\Form\InformationsAnnimauxType;
use App\Repository\InformationsAnnimauxRepository;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/informations/annimaux')]
class InformationsAnnimauxController extends AbstractController
{
    #[Route('/', name: 'app_informations_annimaux_index', methods: ['GET'])]
    public function index(InformationsAnnimauxRepository $informationsAnnimauxRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_annimaux/index.html.twig', [
            'informations_annimauxes' => $informationsAnnimauxRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_informations_annimaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $informationsAnnimaux = new InformationsAnnimaux();
        $form = $this->createForm(InformationsAnnimauxType::class, $informationsAnnimaux);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($informationsAnnimaux);
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_annimaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_annimaux/new.html.twig', [
            'informations_annimaux' => $informationsAnnimaux,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_annimaux_show', methods: ['GET'])]
    public function show(InformationsAnnimaux $informationsAnnimaux, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_annimaux/show.html.twig', [
            'informations_annimaux' => $informationsAnnimaux,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_informations_annimaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InformationsAnnimaux $informationsAnnimaux, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(InformationsAnnimauxType::class, $informationsAnnimaux);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_annimaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_annimaux/edit.html.twig', [
            'informations_annimaux' => $informationsAnnimaux,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_annimaux_delete', methods: ['POST'])]
    public function delete(Request $request, InformationsAnnimaux $informationsAnnimaux, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$informationsAnnimaux->getId(), $request->request->get('_token'))) {
            $entityManager->remove($informationsAnnimaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_informations_annimaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
