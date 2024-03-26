<?php

namespace App\Controller;

use App\Entity\InformationsHorraireDeaprt;
use App\Form\InformationsHorraireDeaprtType;
use App\Repository\InformationsHorraireDeaprtRepository;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/informations/horraire/deaprt')]
class InformationsHorraireDeaprtController extends AbstractController
{
    #[Route('/', name: 'app_informations_horraire_deaprt_index', methods: ['GET'])]
    public function index(InformationsHorraireDeaprtRepository $informationsHorraireDeaprtRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_horraire_deaprt/index.html.twig', [
            'informations_horraire_deaprts' => $informationsHorraireDeaprtRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_informations_horraire_deaprt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $informationsHorraireDeaprt = new InformationsHorraireDeaprt();
        $form = $this->createForm(InformationsHorraireDeaprtType::class, $informationsHorraireDeaprt);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($informationsHorraireDeaprt);
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_horraire_deaprt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_horraire_deaprt/new.html.twig', [
            'informations_horraire_deaprt' => $informationsHorraireDeaprt,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_horraire_deaprt_show', methods: ['GET'])]
    public function show(InformationsHorraireDeaprt $informationsHorraireDeaprt, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_horraire_deaprt/show.html.twig', [
            'informations_horraire_deaprt' => $informationsHorraireDeaprt,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_informations_horraire_deaprt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InformationsHorraireDeaprt $informationsHorraireDeaprt, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(InformationsHorraireDeaprtType::class, $informationsHorraireDeaprt);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_horraire_deaprt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_horraire_deaprt/edit.html.twig', [
            'informations_horraire_deaprt' => $informationsHorraireDeaprt,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_horraire_deaprt_delete', methods: ['POST'])]
    public function delete(Request $request, InformationsHorraireDeaprt $informationsHorraireDeaprt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$informationsHorraireDeaprt->getId(), $request->request->get('_token'))) {
            $entityManager->remove($informationsHorraireDeaprt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_informations_horraire_deaprt_index', [], Response::HTTP_SEE_OTHER);
    }
}
