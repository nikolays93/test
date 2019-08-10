<?php

namespace App;

use App\Traits\SellIn;
use App\Interfaces\IProduct;

/**
 * Uniq change quality
 */
abstract class ProductConcert extends Product implements IProduct
{
    use SellIn;

    function updateQuality()
    {
        $sellIn  = $this->getSellIn();
        $quality = $this->getQuality();

        // Quality drops to 0 after the concert
        if ($sellIn <= 0) {
            $newQuality = 0;
        } // Quality increases by 3 when there are 5 days or less
        elseif ($sellIn <= 5) {
            $newQuality = $quality + 3;
        } // Quality increases by 2 when there are 10 days or less
        elseif ($sellIn <= 10) {
            $newQuality = $quality + 2;
        } else {
            $newQuality = $quality + 1;
        }

        $this->setQuality($newQuality);
    }
}