<?php

namespace App\Controller;

use App\Entity\InformationsHorraireArv;
use App\Form\InformationsHorraireArvType;
use App\Repository\InformationsHorraireArvRepository;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/informations/horraire/arv')]
class InformationsHorraireArvController extends AbstractController
{
    #[Route('/', name: 'app_informations_horraire_arv_index', methods: ['GET'])]
    public function index(InformationsHorraireArvRepository $informationsHorraireArvRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_horraire_arv/index.html.twig', [
            'informations_horraire_arvs' => $informationsHorraireArvRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_informations_horraire_arv_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $informationsHorraireArv = new InformationsHorraireArv();
        $form = $this->createForm(InformationsHorraireArvType::class, $informationsHorraireArv);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($informationsHorraireArv);
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_horraire_arv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_horraire_arv/new.html.twig', [
            'informations_horraire_arv' => $informationsHorraireArv,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_horraire_arv_show', methods: ['GET'])]
    public function show(InformationsHorraireArv $informationsHorraireArv, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('informations_horraire_arv/show.html.twig', [
            'informations_horraire_arv' => $informationsHorraireArv,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_informations_horraire_arv_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InformationsHorraireArv $informationsHorraireArv, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(InformationsHorraireArvType::class, $informationsHorraireArv);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_informations_horraire_arv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('informations_horraire_arv/edit.html.twig', [
            'informations_horraire_arv' => $informationsHorraireArv,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_informations_horraire_arv_delete', methods: ['POST'])]
    public function delete(Request $request, InformationsHorraireArv $informationsHorraireArv, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$informationsHorraireArv->getId(), $request->request->get('_token'))) {
            $entityManager->remove($informationsHorraireArv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_informations_horraire_arv_index', [], Response::HTTP_SEE_OTHER);
    }
}
