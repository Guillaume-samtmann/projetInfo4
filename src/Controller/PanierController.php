<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\User;
use App\Form\Panier1Type;
use App\Repository\MotClesRepository;
use App\Repository\PanierRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'app_panier_index', methods: ['GET'])]
    public function index(PanierRepository $panierRepository): Response
    {
        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_panier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $panier = new Panier();
        $form = $this->createForm(Panier1Type::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/new.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_panier_show', methods: ['GET'])]
    public function show(Panier $panier): Response
    {
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_panier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Panier1Type::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/edit.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    public function addPanier(Request $request, EntityManagerInterface $entityManager, $produitsId, MotClesRepository $motClesRepository): Response
    {
        $produit = $entityManager->getRepository(Produits::class)->find($produitsId);
        $user = $this->getUser();
        $motcles = $motClesRepository->findAll();

        if (!$produit) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Utilisateur non authentifié.');
        }

        // Vérifier si le produit est déjà dans le panier de l'utilisateur
        $existingPanier = $entityManager->getRepository(Panier::class)->findOneBy(['user' => $user, 'produit' => $produit]);
        if ($existingPanier) {
            $this->addFlash('error', 'Vous avez déjà ajouté ce produit à votre panier.');
            return $this->redirectToRoute('panier');
        }

        // Créer un nouvel objet Panier
        $paniers = new Panier();
        $paniers->setProduit($produit);
        $paniers->setUser($user);

        // Persistez le panier
        $entityManager->persist($paniers);
        $entityManager->flush();

        // Redirection vers la page de panier après l'ajout
        return $this->redirectToRoute('panier', [
            'paniers' => $paniers,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_panier_delete', methods: ['POST'])]
    public function delete(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
    }
}
