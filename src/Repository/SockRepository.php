<?php

namespace App\Repository;

use App\Entity\Sock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sock>
 *
 * @method Sock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sock[]    findAll()
 * @method Sock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sock::class);
    }

    public function add(Sock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Socks[] Returns an array of Sock objects
    */
    public function findOrderedByTitle($limit = 2): array
    {
        $entityManager = $this->getEntityManager();

        // DQL request ( Doctrine Query Language )
        $query = $entityManager->createQuery(
        'SELECT s
        FROM App\Entity\Sock s
        ORDER BY s.price DESC'
        )->setMaxResults($limit);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findWithAssociatedData($sockId): ?Sock
    {
        // l'entityManager fait le lien entre les objets en PHP et les lignes dans la BDD
        // lorsque l'on lance la méthode flush(), l'entityManager
        // - mettre à jour les entités que l'on a récupéré de la BDD uniquement si elles ont été modifiées par du code PHP
        // - insérer les entités créées en PHP et que l'on souhaite enregistrer en BDD ( grace à la méthode persist )
        $entityManager = $this->getEntityManager();
        /*
        SELECT movie.*
        FROM movie
        INNER JOIN genre_movie ON  movie.id = genre_movie.movie_id
        INNER JOIN genre ON genre.id = genre_movie.genre_id
        WHERE movie.id = :movieID
        */

        $query = $entityManager->createQuery(
        'SELECT s, b, c
        FROM App\Entity\Sock s
        LEFT JOIN s.brand b
        LEFT JOIN s.category c
        WHERE s.id = :id
        ');
        $query->setParameter('id', $sockId);

        // returns an array of Product objects
        return $query->getOneOrNullResult();
    }

//    /**
//     * @return Sock[] Returns an array of Sock objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sock
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
