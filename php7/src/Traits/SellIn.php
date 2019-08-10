<?php

namespace App\Traits;

trait SellIn
{
    /**
     * SellInAdjust for future
     */
    public function getSellInAdjust(): float
    {
        return -1;
    }

    /**
     * Decrease sell in property
     */
    public function updateSellIn()
    {
        /**
         * @property $this->Item->sell_in
         * @todo check, may be corrupted (case failed)
         * @todo refine, may be negative? if ($item->sell_in > 0) {}
         */
        $newSellIn = $this->getSellIn();
        $newSellIn += $this->getSellInAdjust();

        $this->setSellIn($newSellIn);
    }
}
