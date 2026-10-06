<?php

namespace App\Controller;

use App\Entity\Figurine;
use App\Entity\User;
use App\Form\FigurineType;
use App\Repository\FigurineRepository;
use App\Security\FigurineVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Gère tout ce qui concerne les figurines (CRUD).
 *
 * L'accès à l'ensemble de ces routes est réservé aux utilisateurs connectés
 * (voir access_control dans config/packages/security.yaml).
 */
#[Route('/figurine')]
class FigurineController extends AbstractController
{
    /**
     * Liste de toutes les figurines, de la plus récente à la plus ancienne.
     */
    #[Route('', name: 'app_figurine_index', methods: ['GET'])]
    public function index(FigurineRepository $figurineRepository): Response
    {
        return $this->render('figurine/index.html.twig', [
            'figurines' => $figurineRepository->findAllWithAuthor(),
        ]);
    }

    /**
     * Création d'une nouvelle figurine, rattachée à l'utilisateur connecté.
     */
    #[Route('/create', name: 'app_figurine_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $figurine = new Figurine();
        $form = $this->createForm(FigurineType::class, $figurine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if (!$user instanceof User) {
                throw $this->createAccessDeniedException();
            }

            $figurine->setUser($user);
            $entityManager->persist($figurine);
            $entityManager->flush();

            $this->addFlash('success', 'Figurine créée avec succès.');

            return $this->redirectToRoute('app_figurine_show', ['id' => $figurine->getId()]);
        }

        return $this->render('figurine/create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Détail d'une figurine.
     */
    #[Route('/{id}', name: 'app_figurine_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Figurine $figurine): Response
    {
        return $this->render('figurine/show.html.twig', [
            'figurine' => $figurine,
        ]);
    }

    /**
     * Modification d'une figurine : réservée à son propriétaire (FigurineVoter).
     */
    #[Route('/{id}/edit', name: 'app_figurine_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Figurine $figurine, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted(FigurineVoter::EDIT, $figurine);

        $form = $this->createForm(FigurineType::class, $figurine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // updatedAt est mis à jour automatiquement par le TimestampableTrait (PreUpdate)
            $entityManager->flush();

            $this->addFlash('success', 'Figurine modifiée avec succès.');

            return $this->redirectToRoute('app_figurine_show', ['id' => $figurine->getId()]);
        }

        return $this->render('figurine/edit.html.twig', [
            'form' => $form,
            'figurine' => $figurine,
        ]);
    }

    /**
     * Suppression d'une figurine : réservée à son propriétaire, protégée par un jeton CSRF.
     */
    #[Route('/{id}/delete', name: 'app_figurine_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Figurine $figurine, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted(FigurineVoter::DELETE, $figurine);

        if ($this->isCsrfTokenValid('delete_figurine_' . $figurine->getId(), $request->request->getString('_token'))) {
            $entityManager->remove($figurine);
            $entityManager->flush();

            $this->addFlash('danger', 'Figurine supprimée avec succès.');
        } else {
            $this->addFlash('danger', 'Jeton de sécurité invalide : la suppression a été annulée.');
        }

        return $this->redirectToRoute('app_figurine_index');
    }
}
