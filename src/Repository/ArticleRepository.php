<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use App\Classe\Search;
use App\Repository\ArticleRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        
        parent::__construct($registry, Article::class);
    }
     /**
     * @return Article []
     */
    public function findWithSearch(Search $search)
{
    $query = $this
        ->createQueryBuilder('p')
        ->select('p')
        ->join('p.categorie', 'c'); // Use lowercase 'categorie', assuming it's the property name
    
    if (!empty($search->categories)) {
        $query = $this
        ->createQueryBuilder('p')
        ->select('p')
        ->join('p.categorie', 'c')
        ->andWhere('c.id IN (:categorie)')
         ->setParameter('categorie', $search->categories);
    
    }
    
    return $query->getQuery()->getResult();
}



    

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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
