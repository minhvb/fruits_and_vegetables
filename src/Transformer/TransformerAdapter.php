<?php

namespace App\Transformer;

class TransformerAdapter
{
    public static function getTransformer(string $transformer): UnitTransformerInterface
    {
        if (!class_exists($transformer)) {
            throw new \InvalidArgumentException("Invalid transformer: $transformer");
        }
        $transformer = new $transformer();

        if (!$transformer instanceof UnitTransformerInterface) {
            throw new \InvalidArgumentException("Invalid transformer: $transformer");
        }

        return $transformer;
    }
}
