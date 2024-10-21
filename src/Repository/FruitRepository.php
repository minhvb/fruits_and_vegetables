<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function create(array $data): Fruit
    {
        $fruit = new Fruit();
        $fruit->setName($data['name'] ?? '');
        $fruit->setQuantity($data['quantity'] ?? 0);

        $this->getEntityManager()->persist($fruit);
        $this->getEntityManager()->flush();

        return $fruit;
    }
}
