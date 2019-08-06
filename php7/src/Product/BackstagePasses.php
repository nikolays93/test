<?php

namespace App\Product;

use App\Product;

class BackstagePasses extends Product
{
    /**
     * @override
     */
    public function updateQuality()
    {
        // Quality drops to 0 after the concert
        if ($this->item->sell_in <= 0) {
            $this->item->quality = 0;
        } // Quality increases by 3 when there are 5 days or less
        elseif ($this->item->sell_in <= 5) {
            $this->item->quality += 3;
        } // Quality increases by 2 when there are 10 days or less
        elseif ($this->item->sell_in <= 10) {
            $this->item->quality += 2;
        } else {
            $this->item->quality++;
        }

        parent::stableQuality();
    }
}
