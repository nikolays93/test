<?php

namespace App\Product;

use App\ProductAdjustable;

class Conjured extends ProductAdjustable
{
    const ADJUST = 2;

    public function getQualityAdjust(): Int
    {
        // "Conjured" items degrade in Quality twice as fast as normal items
        return static::ADJUST;
    }
}
