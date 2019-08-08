<?php

namespace App;

Interface IProduct
{
    function updateQuality();
    function updateSellIn();
}

abstract class Product
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Getter
     *
     * @return Int
     */
    public function getSellIn(): Int
    {
        return $this->item->sell_in;
    }

    /**
     * Setter
     *
     * @param Int $sellIn
     */
    public function setSellIn(Int $sellIn)
    {
        $this->item->sell_in = $sellIn;
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getQuality()
    {
        return $this->item->quality;
    }

    /**
     * Setter
     *
     * @param Int $quality
     */
    public function setQuality(Int $quality)
    {
        // The Quality of an item is never more than 50
        if ($quality > 50) $quality = 50;

        // The Quality of an item is never negative
        if ($quality < 0) $quality = 0;

        $this->item->quality = $quality;
    }
}
