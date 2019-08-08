<?php

namespace App\Product;

use App\ProductAdjustable;

class DefaultProduct extends ProductAdjustable
{
    const ADJUST = -1;

    public function getQualityAdjust(): Int
    {
        return static::ADJUST;
    }
}
