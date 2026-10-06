<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Profil de l'utilisateur connecté : affichage et modification.
 */
#[Route('/account')]
class AccountController extends AbstractController
{
    /**
     * Affiche le profil de l'utilisateur connecté.
     */
    #[Route('', name: 'app_account', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('account/show.html.twig', [
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * Modification du prénom, du nom et de l'image de profil.
     */
    #[Route('/edit', name: 'app_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getCurrentUser();

        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Profil modifié avec succès.');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/edit.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }

    /**
     * Retourne l'utilisateur connecté typé, ou refuse l'accès.
     */
    private function getCurrentUser(): User
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        return $user;
    }
}
