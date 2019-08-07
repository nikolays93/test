<?php

namespace App\Product;

use App\AbstractProduct;

class Conjured extends AbstractProduct
{
    public function getQualityAdjust(): Int
    {
        $adjust = -2;
        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->getSellIn() <= 0) {
            $adjust -= 2;
        }

        return $adjust;
    }
}
