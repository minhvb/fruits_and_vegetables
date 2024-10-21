<?php

namespace App\Util;

class UnitConversion
{
    public static function gramToKilogram(float $gram): float
    {
        return $gram / 1000;
    }
}
