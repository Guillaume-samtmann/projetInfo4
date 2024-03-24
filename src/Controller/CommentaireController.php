<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\User;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commentaire')]
class CommentaireController extends AbstractController
{
    #[Route('/', name: 'app_commentaire_index', methods: ['GET'])]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }

    #[Route('/produit/{produitId}/user/{userId}/commentaire/new', name: 'app_commentaire_new', requirements: ['id' => '\d+'])]
    public function new(Request $request, $produitId, $userId, EntityManagerInterface $entityManager, ProduitsRepository $produitsRepository, UserRepository $userRepository): Response
    {
        $produit = $produitsRepository->find($produitId);

        if (!$produit) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }

        $user = $userRepository->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('Le user n\'existe pas.');
        }

        $commentaire = new Commentaire();
        $commentaire->setProduit($produit);// Assigner le produit actuel au commentaire
        $commentaire->setCommentaireUser($user);

        $form = $this->createFormBuilder($commentaire)
            ->add('titre')
            ->add('content')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('produits_showOne', ['id' => $produit->getId()]);
        }

        return $this->render('commentaire/new.html.twig', [
            'form' => $form->createView(),
            'commentaire' => $commentaire,
            'produit' => $produit,
            'user' => $user,
        ]);
    }


    #[Route('/{id}', name: 'app_commentaire_show', methods: ['GET'])]
    public function show(Commentaire $commentaire): Response
    {
        return $this->render('commentaire/show.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commentaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commentaire $commentaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_delete', methods: ['POST'])]
    public function delete(Request $request, Commentaire $commentaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
    }

    public function showCommentaires(Produit $produit, UserRepository $userRepository)
    {
        // Récupérer les commentaires pour ce produit
        $commentaires = $produit->getCommentaires();

        // Passer le repository de l'entité User à la vue Twig
        return $this->render('commentaires/show.html.twig', [
            'commentaires' => $commentaires,
            'userRepository' => $userRepository,
        ]);
    }



}
