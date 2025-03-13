<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\MeasurementReading;
use App\Domain\Repositories\MeasurementReadingRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeasurementReading|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeasurementReading|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeasurementReading[]    findAll()
 * @method MeasurementReading[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeasurementReadingRepository extends ServiceEntityRepository implements MeasurementReadingRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeasurementReading::class);
    }

    public function save(MeasurementReading $reading): void
    {
        $this->getEntityManager()->persist($reading);
        $this->getEntityManager()->flush();
    }

    // /**
    //  * @return MeasurementReading[] Returns an array of MeasurementReading objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MeasurementReading
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}