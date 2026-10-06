<?php

namespace App\Repository;

use App\Entity\Figurine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Figurine>
 */
class FigurineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Figurine::class);
    }

    /**
     * Retourne toutes les figurines, de la plus récente à la plus ancienne,
     * en chargeant l'auteur dans la même requête (évite le problème N+1).
     *
     * @return Figurine[]
     */
    public function findAllWithAuthor(): array
    {
        return $this->createQueryBuilder('f')
            ->addSelect('u')
            ->innerJoin('f.user', 'u')
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
