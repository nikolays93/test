<?php

namespace App\Product;

use App\AbstractProduct;

class Sulfuras extends AbstractProduct
{
    public function getQualityAdjust(): Int
    {
        // do not change quality
        return 0;
    }
}
