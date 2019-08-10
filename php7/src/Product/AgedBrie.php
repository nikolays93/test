<?php

namespace App\Product;

use App\ProductAdjustable;

class AgedBrie extends ProductAdjustable
{
    // "Aged Brie" actually increases in Quality the older it gets
    protected static $adjustQuality = 1;
}
