<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Entity\MotCles;
use App\Repository\MotClesRepository;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;

class index extends AbstractController
{

    #[Route('/ville/', name: 'ville')]
    #[Route('/mot/cles/', name: 'mot-cles')]
    #[Route('/decouvrir/sur/place/', name: 'decouvrirSurPlace')]
    #[Route('/decouvrir/a/proximiter/', name: 'decouvrirAProximiter')]
    #[Route('/produits/', name: 'produits')]

    #[Route('/likes/', name: 'likes')]
    public function likes(): Response
    {
        return $this->render('error404.html.twig', [

        ]);
    }
    #[Route('/autreLien/', name: 'autreLien')]
    public function autreLien(): Response
    {
        return $this->render('error404.html.twig', [

        ]);
    }


    #[Route('/', name: 'home')]
    public function index(MotClesRepository $repository): Response
    {
        $motcles = $repository->findAll();
        return $this->render('home.html.twig', [
            'titre' => 'Bienvenue sur ma page d\'accueil ',
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/produit', name: 'produits_showAll')]
    public function produitsAll(ProduitsRepository $repository): Response {
        $produits = $repository->findAll();

        return $this->render('showAll.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/{id}', name: 'produits_showOne', requirements: ['id' => '\d+'])]
    public function produits(Produits $produits): Response {
        $commentaire = $produits->getCommentaires();
        return $this->render('showOne.html.twig', [
            'produits' => $produits,
            'produit' => $produits,
            'commentaire' =>$commentaire,
            'commentaires' =>$commentaire,

        ]);
    }

    #[Route('/produitfiltre/{motCle}', name: 'produit_filtre')]
    public function filtre($motCle, ProduitsRepository $produitRepository): Response {
        // Récupérer les produits associés au mot-clé donné
        $produitsFiltre = $produitRepository->findByMotCle($motCle);

        return $this->render('showFilter.html.twig', [
            'produits' => $produitsFiltre,
        ]);
    }
    #[Route('/produit_filtreRegion/{region}', name: 'produit_filtreRegion')]
    public function filtreregion($region, ProduitsRepository $produitRepository): Response {
        // Récupérer les produits associés au mot-clé donné
        $produitsFiltre = $produitRepository->findByRegion($region);

        return $this->render('showFilter.html.twig', [
            'produits' => $produitsFiltre,
        ]);
    }

    #[Route('/lepanier', name: 'panier')]
    public function afficherPanier(PanierRepository $panierRepository): Response
    {
        $utilisateur = $this->getUser();
        $paniers = $panierRepository->findByWithProduits(['user' => $utilisateur]);

        // Passer les paniers chargés à la vue Twig pour les afficher
        return $this->render('panier.html.twig', [
            'paniers' => $paniers,
        ]);
    }

    #[Route('/lepanier/delete/{id}', name: 'panierDelete')]
    public function supprimerElementDuPanier(int $id, EntityManagerInterface $entityManager): Response
    {
        $elementDuPanier = $entityManager->getRepository(Panier::class)->find($id);

        if (!$elementDuPanier) {
            throw $this->createNotFoundException('Élément du panier non trouvé');
        }

        $entityManager->remove($elementDuPanier);
        $entityManager->flush();
        return $this->redirectToRoute('panier');
    }
}