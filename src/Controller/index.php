<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\DecouvrirSurPlace;
use App\Entity\Panier;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\CommentaireRepository;
use App\Repository\DecouvrirAProximiterRepository;
use App\Repository\InformationsHorraireArvRepository;
use App\Repository\InformationsHorraireDeaprtRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Entity\MotCles;
use App\Repository\MotClesRepository;
use App\Repository\PanierRepository;
use App\Repository\DecouvrirSurPlaceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RegionRepository;
use App\Repository\InformationsAnnimauxRepository;


class index extends AbstractController
{

    #[Route('/administrateur/ville/', name: 'ville')]
    public function gestionVille(MotClesRepository $motClesRepository, VilleRepository $villeRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('ville/index.html.twig', [
            'villes' => $villeRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }
    #[Route('/administrateur/mot/cles/', name: 'mot-cles')]
    public function gestionMotscles(MotClesRepository $motClesRepository)
    {

        return $this->render('mot_cles/index.html.twig', [
            'mot_cles' => $motClesRepository ->findAll(),
        ]);
    }
    #[Route('/administrateur/decouvrir/sur/place/', name: 'decouvrirSurPlace')]
    public function gestionDecouveteSurPlace(MotClesRepository $motClesRepository, DecouvrirSurPlaceRepository $decouvrirSurPlace)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('decouvrir_sur_place/index.html.twig', [
            'decouvrir_sur_places' => $decouvrirSurPlace->findAll(),
            'mot_cles' => $motcles,
        ]);
    }
    #[Route('/administrateur/decouvrir/a/proximiter/', name: 'decouvrirAProximiter')]
    public function gestionDecouveteProximiter(MotClesRepository $motClesRepository, DecouvrirAProximiterRepository $decouvrirAProximiterRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('decouvrir_a_proximiter/index.html.twig', [
            'decouvrir_a_proximiters' => $decouvrirAProximiterRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/produits/', name: 'produits')]
    public function gestionProduits(MotClesRepository $motClesRepository, ProduitsRepository $produitsRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/region/', name: 'region')]
    public function gestionRegion(MotClesRepository $motClesRepository, RegionRepository $regionRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('region/index.html.twig', [
            'regions' => $regionRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/informations/annimaux/', name: 'infoAnnimaux')]
    public function gestionDesAnnimaux(MotClesRepository $motClesRepository, InformationsAnnimauxRepository $informationsAnnimauxRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('informations_annimaux/index.html.twig', [
            'informations_annimauxes' => $informationsAnnimauxRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/user/', name: 'infoUser')]
    public function gestionDesUser(MotClesRepository $motClesRepository, UserRepository $userRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/commentaire/', name: 'infoCommentaire')]
    public function gestionDesCommentaires(MotClesRepository $motClesRepository, CommentaireRepository $commentaireRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/panier/', name: 'infoPanier')]
    public function gestionDesPanier(MotClesRepository $motClesRepository, PanierRepository $panierRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/informations/horraire/arv/', name: 'infoHorrairesArv')]
    public function gestionDesHorraireArv(MotClesRepository $motClesRepository, InformationsHorraireArvRepository $informationsHorraireArvRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('informations_horraire_arv/index.html.twig', [
            'informations_horraire_arvs' => $informationsHorraireArvRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur/informations/horraire/deaprt/', name: 'infoHorrairesDepart')]
    public function gestionDesHorraireDepart(MotClesRepository $motClesRepository, InformationsHorraireDeaprtRepository $informationsHorraireDeaprtRepository)
    {
        $motcles = $motClesRepository->findAll();

        return $this->render('informations_horraire_deaprt/index.html.twig', [
            'informations_horraire_deaprts' => $informationsHorraireDeaprtRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/likes/', name: 'likes')]
    public function likes(): Response
    {
        return $this->render('error404.html.twig', [

        ]);
    }
    #[Route('/autreLien/', name: 'autreLien')]
    public function autreLien(MotClesRepository $repository): Response
    {
        $motcles = $repository->findAll();
        return $this->render('error404.html.twig', [
            'mot_cles' => $motcles,

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

    #[Route('/', name: 'base')]
    public function base(MotClesRepository $repository): Response
    {
        $motcles = $repository->findAll();


        return $this->render('base.html.twig', [
            'titre' => 'Bienvenue sur ma page d\'accueil ',
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/produit', name: 'produits_showAll')]
    public function produitsAll(ProduitsRepository $repository, MotClesRepository $motClesRepository, RegionRepository $regionRepository ): Response {
        $produits = $repository->findAll();

        $motcles = $motClesRepository->findAll();

        $region = $regionRepository->findAll();

        return $this->render('showAll.html.twig', [
            'produits' => $produits,
            'mot_cles' => $motcles,
            'regions' => $region,
        ]);
    }

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/produit/{id}', name: 'produits_showOne', requirements: ['id' => '\d+'])]
    public function produits(Produits $produits, MotClesRepository $motClesRepository): Response {
        $commentaires = $produits->getCommentaires();
        $motcles = $motClesRepository->findAll();

        // Vous pouvez maintenant parcourir les commentaires et obtenir l'utilisateur associé
        $commentairesAvecUtilisateur = [];
        foreach ($commentaires as $commentaire) {
            $commentaireUser = $commentaire->getCommentaireUser();
            if ($commentaireUser) {
                $utilisateur = $this->userRepository->find($commentaireUser->getId());
                $commentaire->setCommentaireUser($utilisateur);
            } else {
                $commentaire->setCommentaireUser(null);
            }
            $commentairesAvecUtilisateur[] = $commentaire;
        }

        return $this->render('showOne.html.twig', [
            'produit' => $produits,
            'commentaires' => $commentairesAvecUtilisateur,
            'mot_cles' => $motcles,
        ]);
    }
    #[Route('/produitfiltre/{motCle}', name: 'produit_filtre')]
    public function filtre($motCle, ProduitsRepository $produitRepository, MotClesRepository $motClesRepository, RegionRepository $regionRepository): Response {
        // Récupérer les produits associés au mot-clé donné
        $produitsFiltre = $produitRepository->findByMotCle($motCle);
        $motcles = $motClesRepository->findAll();
        $region = $regionRepository->findAll();
        $nomMotCles = $motClesRepository->findOneBy(['nom' => $motCle]) ->getNom();
        $nomRegion = $regionRepository->findOneBy(['nom' => $region]);


        return $this->render('showFilter.html.twig', [
            'produits' => $produitsFiltre,
            'mot_cles' => $motcles,
            'regions' => $region,
            'nom_mot_cle' => $nomMotCles,
            'nom_region' =>$nomRegion,
        ]);
    }
    #[Route('/produit_filtreRegion/{region}/{motCle?}', name: 'produit_filtreRegion')]
    public function filtreregion($region, ProduitsRepository $produitRepository, MotClesRepository $motClesRepository, RegionRepository $regionRepository, $motCle = null): Response {
        // Récupérer les produits associés au mot-clé donné
        $produitsFiltre = $produitRepository->findByRegion($region);
        $nomMotCles = $motClesRepository->findOneBy(['nom' => $motCle]);
        $motcles = $motClesRepository->findAll();
        $regions = $regionRepository->findAll();
        $nomRegion = $region;

        return $this->render('showFilter.html.twig', [
            'produits' => $produitsFiltre,
            'mot_cles' => $motcles,
            'regions' => $regions,
            'nom_mot_cle' => $nomMotCles,
            'nom_region' =>$nomRegion,
        ]);
    }

    #[Route('/lepanier', name: 'panier')]
    public function afficherPanier(PanierRepository $panierRepository, MotClesRepository $motClesRepository): Response
    {
        $utilisateur = $this->getUser();
        $paniers = $panierRepository->findBy(['user' => $utilisateur]);
        $motcles = $motClesRepository->findAll();

        // Passer les paniers chargés à la vue Twig pour les afficher
        return $this->render('panier.html.twig', [
            'paniers' => $paniers,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/lepanier/delete/{id}', name: 'panierDelete')]
    public function supprimerElementDuPanier(int $id, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $elementDuPanier = $entityManager->getRepository(Panier::class)->find($id);
        $motcles = $motClesRepository->findAll();

        if (!$elementDuPanier) {
            throw $this->createNotFoundException('Élément du panier non trouvé');
        }

        $entityManager->remove($elementDuPanier);
        $entityManager->flush();
        return $this->render('home.html.twig', [

            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/administrateur', name: 'administrateur')]
    public function administrateur(MotClesRepository $repository): Response
    {
        $motcles = $repository->findAll();
        return $this->render('administrateur.html.twig', [
            'mot_cles' => $motcles,

        ]);
    }

    #[Route('/confirmation/{id}', name: 'confirmation')]
    public function confirmation(int $id, EntityManagerInterface $entityManager, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        $elementDuPanier = $entityManager->getRepository(Panier::class)->find($id);
        $entityManager->remove($elementDuPanier);
        $entityManager->flush();
        return $this->render('confirmation.html.twig', [
            'mot_cles' => $motcles,
        ]);

    }
}