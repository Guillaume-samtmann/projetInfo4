<?php

namespace App\Controller;

use App\Entity\MotCles;
use App\Form\MotClesType;
use App\Repository\MotClesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mot/cles')]
class MotClesController extends AbstractController
{
    #[Route('/', name: 'app_mot_cles_index', methods: ['GET'])]
    public function index(MotClesRepository $motClesRepository): Response
    {
        return $this->render('mot_cles/index.html.twig', [
            'mot_cles' => $motClesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mot_cles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $motCle = new MotCles();
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            // Si un fichier a été envoyé (l'usage du bouton est facultatif)
            if ($image) {
                // On fabrique un nom de fichier unique avec l'id du chateau
                // Pour que l'id soit défini, il faut enregistrer l'entité dans la BDD (qui génère la clé)
                $motCle->setImage("tmp"); // il faut un nom de fichier temporaire (not null)
                $entityManager->persist($motCle);
                $entityManager->flush();
                // Ensuite on fixe le nom du fichier en utilisant l'extension (devinée d'après le type mime)
                $filename = 'image-'.$motCle->getId().'.'.$image->guessExtension();
                // Enregistre le nom du fichier dans l'entité
                $motCle->setImage($filename);
                // Renomme le fichier téléchargé et le déplace dans le dossier "uploads" (à mettre dans "public")
                $image->move('uploads', $filename);
            }
            $entityManager->persist($motCle);
            $entityManager->flush();

            return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mot_cles/newCommentaire.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mot_cles_show', methods: ['GET'])]
    public function show(MotCles $motCle): Response
    {
        return $this->render('mot_cles/show.html.twig', [
            'mot_cle' => $motCle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mot_cles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MotCles $motCle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MotClesType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                if (file_exists('uploads/' . $motCle->getImage()))
                    unlink('uploads/' . $motCle->getImage());

                $filename = 'image-'.$motCle->getId().'.'.$image->guessExtension();
                $motCle->setImage($filename);
                $image->move('uploads', $filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mot_cles/edit.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mot_cles_delete', methods: ['POST'])]
    public function delete(Request $request, MotCles $motCle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motCle->getId(), $request->request->get('_token'))) {
            if (file_exists('uploads/' . $motCle->getImage()))
                // Si oui le supprime
                unlink('uploads/' . $motCle->getImage());

            $entityManager->remove($motCle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mot_cles_index', [], Response::HTTP_SEE_OTHER);
    }
}
