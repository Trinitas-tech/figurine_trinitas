<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Connexion et déconnexion des utilisateurs.
 */
class SecurityController extends AbstractController
{
    /**
     * Affiche le formulaire de connexion. La soumission est traitée par le
     * firewall (form_login) configuré dans security.yaml.
     */
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Un utilisateur déjà connecté n'a rien à faire ici
        if ($this->getUser()) {
            return $this->redirectToRoute('app_figurine_index');
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * Route interceptée par le firewall : le corps de la méthode n'est jamais exécuté.
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('Cette méthode est interceptée par la clé "logout" du firewall.');
    }
}
