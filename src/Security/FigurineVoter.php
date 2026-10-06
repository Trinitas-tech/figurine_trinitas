<?php

namespace App\Security;

use App\Entity\Figurine;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Autorise la modification / suppression d'une figurine uniquement à son propriétaire.
 *
 * @extends Voter<string, Figurine>
 */
class FigurineVoter extends Voter
{
    public const EDIT = 'FIGURINE_EDIT';
    public const DELETE = 'FIGURINE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE], true)
            && $subject instanceof Figurine;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Utilisateur anonyme : accès refusé
        if (!$user instanceof User) {
            return false;
        }

        /** @var Figurine $figurine */
        $figurine = $subject;

        // EDIT et DELETE suivent la même règle : il faut être le propriétaire
        return $figurine->getUser() === $user;
    }
}
