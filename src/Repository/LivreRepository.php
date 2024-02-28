<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

// La liste des livres dont la première lettre commence par …

public function findLivresByFirstLetter(string $letter)
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT livre
        FROM App\Entity\Livre livre
        WHERE livre.titre LIKE :letter
        ORDER BY livre.titre ASC
        '
    );

    $query->setParameter('letter', $letter.'%');

    return $query->getResult();
}

public function countTotalBooks()
{
    $queryBuilder = $this->createQueryBuilder('l');

    return $queryBuilder
        ->select('COUNT(l.id) as totalBooks')
        ->getQuery()
        ->getSingleScalarResult();
}

public function getNbLivres()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT COUNT(livre.id)
        FROM App\Entity\Livre livre'
    );

    return $query->getSingleScalarResult();
}

public function findAuthorsWithMoreThanXBooks($numberOfBooks)
{
    $entityManager = $this->getEntityManager();
    
    $dql = "SELECT a, count(l) AS NBLivres FROM App\Entity\Auteur a JOIN a.livres l GROUP BY a.id HAVING NBLivres > :numberOfBooks ORDER BY NBLivres DESC";

    $query = $entityManager->createQuery($dql)
        ->setParameter('numberOfBooks', $numberOfBooks);

    return $query->getResult();
}



//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
