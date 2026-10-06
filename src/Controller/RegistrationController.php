<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Inscription des nouveaux utilisateurs.
 */
class RegistrationController extends AbstractController
{
    /**
     * Formulaire d'inscription : le mot de passe est haché avant l'enregistrement.
     */
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_figurine_index');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('info', 'Inscription réussie ! Bienvenue sur FigurineVie, ' . $user->getFirstname() . '.');

            // Pas d'envoi d'email dans ce projet : on simule le clic sur le lien de vérification
            return $this->redirectToRoute('app_verify_email', ['id' => $user->getId()]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    /**
     * Vérification de l'email : marque le compte comme vérifié puis renvoie vers la connexion.
     * Dans un projet réel, ce lien (/verify/email?id=...) serait envoyé par email signé.
     */
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = $userRepository->find($request->query->getInt('id'));

        if (null === $user) {
            $this->addFlash('danger', "Lien de vérification invalide : utilisateur introuvable.");

            return $this->redirectToRoute('app_register');
        }

        if (!$user->isVerified()) {
            $user->setIsVerified(true);
            $entityManager->flush();
        }

        $this->addFlash('info', 'Votre adresse email est vérifiée. Vous pouvez vous connecter.');

        return $this->redirectToRoute('app_login');
    }
}
