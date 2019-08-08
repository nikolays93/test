<?php

namespace App\Product;

use App\ProductAdjustable;

class AgedBrie extends ProductAdjustable
{
    const ADJUST = 1;

    public function getQualityAdjust(): Int
    {
        // "Aged Brie" actually increases in Quality the older it gets
        return static::ADJUST;
    }
}
