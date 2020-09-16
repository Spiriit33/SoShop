<?php

namespace App\Repository;

use App\Entity\Carte;
use App\Entity\Compte;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByEmail(string $email) : string
    {

        $query = $this->createQueryBuilder('u')
            ->setParameter(':email', '%' . $email . '%')
            ->where('u.email = :email')
            ->orwhere('u.email LIKE :email')
            ->getQuery()
            ->getArrayResult();

        return json_encode($query);
    }

    public function findByReferenceCompte(string $reference) : string
    {
        $query = $this->createQueryBuilder('u')
            ->setParameter(':ref', $reference)
            ->join(Compte::class, 'c', 'WITH', 'c.user = u.id')
            ->where('c.reference = :ref')
            ->getQuery()
            ->getArrayResult();

        return json_encode($query);
    }

    public function findByReferenceCarte(string $reference) : array
    {
        $query = $this->createQueryBuilder('u')
            ->setParameter(':ref', $reference)
            ->join(Compte::class, 'c', 'WITH', 'c.user = u.id')
            ->join(Carte::class, 'ca', 'WITH', 'ca.compte = c.id')
            ->where('ca.reference_carte = :ref')
            ->getQuery()
            ->getArrayResult();

        return json_encode($query);
    }
}
