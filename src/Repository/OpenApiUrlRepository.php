<?php

namespace App\Repository;

use App\Entity\OpenApiUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OpenApiUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpenApiUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpenApiUrl[]    findAll()
 * @method OpenApiUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpenApiUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenApiUrl::class);
    }
}
