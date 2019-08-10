<?php

namespace App;

use App\Traits\SellIn;
use App\Interfaces\IProduct;

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
        // Default quality may be 50 max, do not use it.
        // $this->setQuality(80);
    }
}
