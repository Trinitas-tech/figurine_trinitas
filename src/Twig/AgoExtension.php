<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Filtre Twig « ago » : affiche depuis combien de temps une date est passée
 * (ex. « il y a 3 jours »).
 */
class AgoExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', $this->formatAgo(...)),
        ];
    }

    public function formatAgo(\DateTimeInterface $date): string
    {
        $diff = (new \DateTimeImmutable())->diff($date);

        // Chaque unité : [valeur, singulier, pluriel]
        $units = [
            [$diff->y, 'an', 'ans'],
            [$diff->m, 'mois', 'mois'],
            [$diff->d, 'jour', 'jours'],
            [$diff->h, 'heure', 'heures'],
            [$diff->i, 'minute', 'minutes'],
        ];

        foreach ($units as [$value, $singular, $plural]) {
            if ($value > 0) {
                return sprintf('il y a %d %s', $value, $value > 1 ? $plural : $singular);
            }
        }

        return "à l'instant";
    }
}
