<?php

namespace App\Product;

use App\Product;

class Conjured extends Product
{
    /**
     * @override
     */
    public function updateQuality()
    {
        $this->item->quality -= 2;

        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->item->sell_in <= 0) {
            $this->item->quality -= 2;
        }

        parent::stableQuality();
    }
}
