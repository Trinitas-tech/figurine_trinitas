<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

/**
 * Ajoute le message flash « Bienvenue prénom » après une connexion réussie.
 */
class LoginSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccess',
        ];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $user = $event->getUser();
        $session = $event->getRequest()->getSession();

        if ($user instanceof User && $session instanceof FlashBagAwareSessionInterface) {
            $session->getFlashBag()->add('info', 'Bienvenue ' . $user->getFirstname() . ' !');
        }
    }
}
