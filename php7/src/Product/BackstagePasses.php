<?php

namespace App\Product;

use App\AbstractProduct;

class BackstagePasses extends AbstractProduct
{
    public function getQualityAdjust(): Int
    {
        $sellIn = $this->getSellIn();
        $adjust = 1;
        // Quality drops to 0 after the concert
        if ($sellIn <= 0) {
            // reset quality
            $adjust = -$this->getQuality();
        } // Quality increases by 3 when there are 5 days or less
        elseif($sellIn <= 5) {
            $adjust = 3;
        } // Quality increases by 2 when there are 10 days or less
        elseif($sellIn <= 10) {
            $adjust = 2;
        }

        return $adjust;
    }
}
