<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produits;
use App\Form\PanierType;
use App\Repository\MotClesRepository;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'app_panier_index', methods: ['GET'])]
    public function index(PanierRepository $panierRepository,MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_panier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $panier = new Panier();
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/newCommentaire.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_panier_show', methods: ['GET'])]
    public function show($id, MotClesRepository $motClesRepository, PanierRepository $panierRepository): Response
    {
        $panier = $panierRepository->find($id);
        $produitsDuPanier = $panier->getProduit();
        $motcles = $motClesRepository->findAll();

        return $this->render('panier/show.html.twig', [
            'paniers' => $produitsDuPanier,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_panier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PanierType::class, $panier);
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

    #[Route('/{id}/', name: 'app_panier_delete', methods: ['POST'])]
    public function delete(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
    }







    #[Route("/ajouter-au-panier/{id}", name:'ajouter_au_panier')]
    public function ajouterAuPanier(Produits $produit, Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = $this->getUser();

        // Vérifier si l'utilisateur est connecté
        if (!$utilisateur) {
            // Gérer le cas où l'utilisateur n'est pas connecté
            // Redirection vers la page de connexion par exemple
            // ...

            return $this->redirectToRoute('app_login');
        }

        // Créer un nouvel objet Panier
        $panier = new Panier();
        $panier->addProduit($produit);
        $panier->setUtilisateur($utilisateur);
        $panier->setNom('Panier_' . time());

        // Persistez le panier
        $entityManager->persist($panier);

        // Flush pour enregistrer le panier en base de données
        $entityManager->flush();

        // Pour cette version simplifiée, supposons que le panier est juste stocké en session
        $paniers = $request->getSession()->get('paniers', []);
        $paniers[] = $panier;
        $request->getSession()->set('paniers', $paniers);

        // Redirection vers une autre page (optionnel)
        return $this->redirectToRoute('panier');
    }




}
