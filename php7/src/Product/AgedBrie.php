<?php

namespace App\Product;

use App\AbstractProduct;

class AgedBrie extends AbstractProduct
{
    public function getQualityAdjust(): Int
    {
        // "Aged Brie" actually increases in Quality the older it gets
        $adjust = 1;

        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->getSellIn() <= 0) {
            $adjust++;
        }

        return $adjust;
    }
}
