<?php

namespace App\Transformer;

interface UnitTransformerInterface
{
    public function transform(array $data): array;
}
