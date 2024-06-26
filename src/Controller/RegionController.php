<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\MotClesRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/region')]
class RegionController extends AbstractController
{
    #[Route('/', name: 'app_region_index', methods: ['GET'])]
    public function index(RegionRepository $regionRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('region/index.html.twig', [
            'regions' => $regionRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_region_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $region = new Region();
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($region);
            $entityManager->flush();

            return $this->redirectToRoute('app_region_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('region/new.html.twig', [
            'region' => $region,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_region_show', methods: ['GET'])]
    public function show(Region $region, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('region/show.html.twig', [
            'region' => $region,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_region_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Region $region, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_region_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('region/edit.html.twig', [
            'region' => $region,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_region_delete', methods: ['POST'])]
    public function delete(Request $request, Region $region, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$region->getId(), $request->request->get('_token'))) {
            $entityManager->remove($region);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_region_index', [], Response::HTTP_SEE_OTHER);
    }
}
