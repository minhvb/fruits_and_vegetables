<?php

namespace App\Transformer;

class GramTransformer implements UnitTransformerInterface
{
    public function transform(array $data): array
    {
        return $data;
    }
}