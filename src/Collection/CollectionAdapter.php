<?php

namespace App\Collection;

class CollectionAdapter
{
    private FruitCollection $fruitCollection;
    private VegetableCollection $vegetableCollection;

    public function __construct(FruitCollection $fruitCollection, VegetableCollection $vegetableCollection)
    {
        $this->fruitCollection = $fruitCollection;
        $this->vegetableCollection = $vegetableCollection;
    }

    public function getCollection(string $type): CollectionInterface
    {
        return match ($type) {
            'fruit' => $this->fruitCollection,
            'vegetable' => $this->vegetableCollection,
            default => throw new \InvalidArgumentException("Invalid type: $type"),
        };
    }
}
