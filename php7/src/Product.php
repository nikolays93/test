<?php

namespace App;

class Product extends AbstractProduct {
    protected $item;

    public function __construct(Item $item) {
        $this->item = $item;
    }

    public function stableQuality()
    {
        // The Quality of an item is never more than 50
        if( $this->item->quality > 50 ) {
            $this->item->quality = 50;
        }

        // The Quality of an item is never negative
        if( $this->item->quality < 0 ) {
            $this->item->quality = 0;
        }
    }

    /**
     * Degrade sell in property
     */
    public function updateSellIn()
    {
        /**
         * @property Item->sell_in
         *           @todo check, may be corrupted (case failed)
         *           @todo refine, may be negative? if ($item->sell_in > 0) {}
         */
        $this->item->sell_in -= 1;
    }

    public function updateQuality()
    {
        $this->item->quality--;

        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->item->sell_in <= 0) {
            $this->item->quality--;
        }

        $this->stableQuality();
    }

    public function setQuality($quality)
    {
        $this->item->quality = $quality;
        $this->stableQuality();
    }
}
