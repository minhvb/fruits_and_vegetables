<?php

namespace App\Collection;

use App\Entity\Vegetable;

class VegetableCollection extends AbstractCollection
{
    public static string $type = 'vegetable';

    public function getEntityClass(): string
    {
        return Vegetable::class;
    }

    public function add(array $data): Vegetable
    {
        $vegetable = new Vegetable();
        $vegetable->setName($data['name'] ?? '');
        $vegetable->setQuantity($data['quantity'] ?? 0);
        $this->store($vegetable);

        return $vegetable;
    }
}
