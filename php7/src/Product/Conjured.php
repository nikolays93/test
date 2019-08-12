<?php

namespace App\Product;

use App\ProductAdjustable;

class Conjured extends ProductAdjustable
{
    // "Conjured" items degrade in Quality twice as fast as normal items
    protected static $adjustQuality = -2;
}
