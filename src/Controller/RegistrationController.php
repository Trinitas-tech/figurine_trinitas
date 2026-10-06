<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * Inscription des nouveaux utilisateurs et vérification de leur adresse email.
 */
class RegistrationController extends AbstractController
{
    public function __construct(private readonly EmailVerifier $emailVerifier)
    {
    }

    /**
     * Formulaire d'inscription : le mot de passe est haché, puis un email de
     * confirmation contenant un lien signé est envoyé (Mailtrap en développement).
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

            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@figurinevie.be', 'FigurineVie'))
                    ->to((string) $user->getEmail())
                    ->subject('Confirmez votre adresse email - FigurineVie')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->addFlash('info', sprintf(
                'Inscription réussie ! Bienvenue %s. Un email de confirmation vous a été envoyé à %s.',
                $user->getFirstname(),
                $user->getEmail()
            ));

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    /**
     * Cible du lien reçu par email : vérifie la signature puis marque le compte comme vérifié.
     */
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(
        Request $request,
        UserRepository $userRepository,
        TranslatorInterface $translator,
    ): Response {
        $user = $userRepository->find($request->query->getInt('id'));

        if (null === $user) {
            $this->addFlash('danger', 'Lien de vérification invalide : utilisateur introuvable.');

            return $this->redirectToRoute('app_register');
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('danger', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('info', 'Votre adresse email est vérifiée. Vous pouvez vous connecter.');

        return $this->redirectToRoute('app_login');
    }
}
