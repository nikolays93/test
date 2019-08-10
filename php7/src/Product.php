<?php

namespace App;

abstract class Product
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Getter
     *
     * @return float
     */
    public function getSellIn(): float
    {
        return $this->item->sell_in;
    }

    /**
     * Setter
     *
     * @param float $sellIn
     */
    public function setSellIn(float $sellIn)
    {
        $this->item->sell_in = $sellIn;
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getQuality(): float
    {
        return $this->item->quality;
    }

    /**
     * Setter
     *
     * @param float $quality
     */
    public function setQuality(float $quality)
    {
        // The Quality of an item is never more than 50
        if ($quality > 50) {
            $quality = 50;
        }

        // The Quality of an item is never negative
        if ($quality < 0) {
            $quality = 0;
        }

        $this->item->quality = $quality;
    }
}
