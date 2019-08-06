<?php

namespace App\Product;

use App\Product;

class Sulfuras extends Product
{
    /**
     * Decrase sell in property
     * @override
     */
    public function updateSellIn()
    {
        // do not decrase in Sulfuras
    }

    /**
     * @override
     */
    public function updateQuality()
    {
        $this->item->quality = 80;
    }
}
