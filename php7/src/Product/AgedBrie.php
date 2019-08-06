<?php

namespace App\Product;

use App\Product;

class AgedBrie extends Product
{
    /**
     * @override
     */
    public function updateQuality()
    {
        // "Aged Brie" actually increases in Quality the older it gets
        $this->item->quality++;

        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->item->sell_in <= 0) {
            $this->item->quality++;
        }

        parent::stableQuality();
    }
}
