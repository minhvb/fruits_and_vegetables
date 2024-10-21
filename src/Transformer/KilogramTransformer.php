<?php

namespace App\Transformer;

use App\Entity\Item;
use App\Util\UnitConversion;

class KilogramTransformer implements UnitTransformerInterface
{
    /**
     * @param Item[] $data
     */
    public function transform(array $data): array
    {
        return array_map(function (Item $fruit) {
            return [
                'name' => $fruit->getName(),
                'quantity' => UnitConversion::gramToKilogram($fruit->getQuantity())
            ];
        }, $data);
    }
}
