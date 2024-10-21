<?php

namespace App\Service;
use App\Collection\FruitCollection;
use App\Collection\VegetableCollection;
use App\Entity\Fruit;
use App\Entity\Vegetable;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Contracts\Service\Attribute\Required;

class StorageService
{
    protected readonly FruitCollection $fruitCollection;
    protected readonly VegetableCollection $vegetableCollection;
    private readonly string $request;

    public function __construct(string $requestPath)
    {
        $this->request = file_get_contents($requestPath);
    }

    #[Required]
    public function setFruitCollection(FruitCollection $fruitCollection): void
    {
        $this->fruitCollection = $fruitCollection;
    }

    #[Required]
    public function setVegetableCollection(VegetableCollection $vegetableCollection): void
    {
        $this->vegetableCollection = $vegetableCollection;
    }

    public function setItems(): void
    {
        $items = json_decode($this->request, true);

        foreach ($items as $itemData) {
            switch ($itemData['type']) {
                case FruitCollection::$type:
                    $this->fruitCollection->add($itemData);
                    break;
                case VegetableCollection::$type:
                    $this->vegetableCollection->add($itemData);
                    break;
            }
        }
    }
}
