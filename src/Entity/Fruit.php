<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
#[ORM\Table(name: 'fruits')]
#[ORM\Index(name: "name_idx", columns: ["name"])]
#[ORM\Index(name: "quantity_idx", columns: ["quantity"])]
class Fruit extends Item implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
        ];
    }
}
