<?php

namespace App\Collection;

use App\Entity\Item;

interface CollectionInterface
{
    public function store(Item $item): void;
    public function remove(Item $item): void;
    public function list(): array;
    public function search(array $filters, string $unit): array;
}
