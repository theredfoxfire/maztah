<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function findByKeyword($keyword = null) {
        $entityManager = $this->getEntityManager();

        if ($keyword) {
            $query = $entityManager->createQuery(
                'SELECT q
                FROM App\Entity\Question q
                WHERE q.description like :keyword or q.title like :keyword
                ORDER BY q.createdAt DESC'
            )->setParameter('keyword', '%'.$keyword.'%');
        } else {
            $query = $entityManager->createQuery(
                'SELECT q
                FROM App\Entity\Question q
                ORDER BY q.createdAt DESC'
            );
        }

        return $query->execute();
    }

    public function queryByKeyword($keyword = null) {
        $entityManager = $this->getEntityManager();

        if ($keyword) {
            $query = $entityManager->createQuery(
                'SELECT q
                FROM App\Entity\Question q
                WHERE q.description like :keyword or q.title like :keyword
                ORDER BY q.createdAt DESC'
            )->setParameter('keyword', '%'.$keyword.'%');
        } else {
            $query = $entityManager->createQuery(
                'SELECT q
                FROM App\Entity\Question q
                ORDER BY q.createdAt DESC'
            );
        }

        return $query;
    }

    // /**
    //  * @return Question[] Returns an array of Question objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
