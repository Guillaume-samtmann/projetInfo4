<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Entity\MotCles;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;

class index extends AbstractController
{

    #[Route('/ville/', name: 'ville')]
    #[Route('/mot/cles/', name: 'mot-cles')]
    #[Route('/decouvrir/sur/place/', name: 'decouvrirSurPlace')]
    #[Route('/decouvrir/a/proximiter/', name: 'decouvrirAProximiter')]
    #[Route('/produits/', name: 'produits')]


    #[Route('/', name: 'home')]
    public function index(ProduitsRepository $repository): Response
    {
        $produits = $repository->findAll();
        return $this->render('home.html.twig', [
            'titre' => 'Bienvenue sur ma page d\'accueil non terminer',
            'produits' => $produits,
        ]);
    }

    #[Route('/produit', name: 'produits_showAll')]
    public function produitsAll(ProduitsRepository $repository): Response {
        $produits = $repository->findAll();

        return $this->render('showAll.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produits/{id}', name: 'produits_showOne', requirements: ['id' => '\d+'])]
    public function produits(Produits $produits): Response {
        return $this->render('showOne.html.twig', [
            'produits' => $produits,
            'produit' => $produits
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
}