<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;

class index extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Route('/ville/', name: 'ville')]
    #[Route('/mot/cles/', name: 'mot-cles')]
    #[Route('/produits/', name: 'produits')]
    public function index(ProduitsRepository $repository): Response
    {
        $produits = $repository->findAll();

        return $this->render('home.html.twig', [
            'titre' => 'Bienvenue sur ma page d\'accueil',
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
}