<?php

namespace App\Collection;

use App\Entity\Fruit;

class FruitCollection extends AbstractCollection
{
    public static string $type = 'fruit';

    public function getEntityClass(): string
    {
        return Fruit::class;
    }

    public function add(array $data): Fruit
    {
        $fruit = new Fruit();
        $fruit->setName($data['name'] ?? '');
        $fruit->setQuantity($data['quantity'] ?? 0);
        $this->store($fruit);

        return $fruit;
    }
}
