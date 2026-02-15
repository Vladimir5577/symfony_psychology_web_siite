<?php

namespace App\Repository;

use App\Entity\Block;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Block>
 */
class BlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Block::class);
    }

    public function findOneByPageSlugAndBlockSlug(string $pageSlug, string $blockSlug): ?Block
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.page', 'p')
            ->andWhere('p.slug = :pageSlug')
            ->andWhere('b.slug = :blockSlug')
            ->andWhere('b.isActive = :active')
            ->setParameter('pageSlug', $pageSlug)
            ->setParameter('blockSlug', $blockSlug)
            ->setParameter('active', true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Block[] Returns an array of Block objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Block
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
