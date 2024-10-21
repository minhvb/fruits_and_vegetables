<?php

namespace App\Entity;

use App\Repository\VegetableRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: VegetableRepository::class)]
#[ORM\Table(name: 'vegetables')]
#[ORM\Index(name: "name_idx", columns: ["name"])]
#[ORM\Index(name: "quantity_idx", columns: ["quantity"])]
class Vegetable extends Item implements JsonSerializable
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
