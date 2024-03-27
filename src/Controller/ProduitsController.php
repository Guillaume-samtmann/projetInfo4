<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\MotClesRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('produits')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('new', name: 'app_produits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('photo')->getData();
            if ($image) {
                $produit->setPhoto("tmp"); // il faut un nom de fichier temporaire (not null)
                $entityManager->persist($produit);
                $entityManager->flush();
                $filename = 'image-'.$produit->getId().'.'.$image->guessExtension();
                $produit->setPhoto($filename);
                $image->move('uploads', $filename);
            }
            $image2 = $form->get('photo2')->getData();
            if ($image2) {
                $produit->setPhoto2("tmp"); // il faut un nom de fichier temporaire (not null)
                $entityManager->persist($produit);
                $entityManager->flush();
                $filename = 'image-'.$produit->getId().'.'.$image2->guessExtension();
                $produit->setPhoto2($filename);
                $image2->move('uploads', $filename);
            }
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('{id}', name: 'app_produits_show', methods: ['GET'])]
    public function show(Produits $produit, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('{id}/edit', name: 'app_produits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produits $produit, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);
        $motcles = $motClesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('photo')->getData();
            if ($image) {
                if (file_exists('uploads/' . $produit->getPhoto()))
                    unlink('uploads/' . $produit->getPhoto());

                $filename = 'photodepresentation-'.$produit->getId().'.'.$image->guessExtension();
                $produit->setPhoto($filename);
                $image->move('uploads', $filename);
            }
            $image2 = $form->get('photo2')->getData();
            if ($image2) {
                if (file_exists('uploads/' . $produit->getPhoto2()))
                    unlink('uploads/' . $produit->getPhoto2());

                $filename = 'photodepresentation2-'.$produit->getId().'.'.$image2->guessExtension();
                $produit->setPhoto2($filename);
                $image2->move('uploads', $filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('{id}', name: 'app_produits_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }
}
