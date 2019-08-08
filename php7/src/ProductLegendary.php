<?php

namespace App;

/**
 * Do not change quality
 */
abstract class ProductLegendary extends Product implements IProduct
{
    use SellIn;

    public function __construct(Item $item)
    {
        $item->quality = 80;
        parent::__construct($item);
    }

    // pass quality
    function updateQuality()
    {
    }
}
