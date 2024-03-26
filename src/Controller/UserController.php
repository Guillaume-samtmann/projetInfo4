<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\MotClesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;



#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    Public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, MotClesRepository $repository, CsrfTokenManagerInterface $csrfTokenManager): Response
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $motcles = $repository->findAll();
        // Récupérer le jeton CSRF de la requête
        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->isCsrfTokenValid('user_registration', $csrfToken)) {

        }

        if ($form->isSubmitted() && $form->isValid()) {
            // récupère le mot de passe saisi
		$plaintextPassword = $user->getPassword();

	        // crypte le mot de passe
		$hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);

		// remplace le mot de passe saisi par le mot de passe crypté
		$user->setPassword($hashedPassword);

		// enregistre les informations
		$entityManager->persist($user);
		$entityManager->flush();

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);

        } else {
            
            return $this->redirectToRoute('app_login');

        }

        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user, MotClesRepository $motClesRepository): Response
    {
        $motcles = $motClesRepository->findAll();
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, MotClesRepository $repository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
        $motcles = $repository->findAll();

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'mot_cles' => $motcles,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
