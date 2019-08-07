<?php

namespace App;

abstract class AbstractProduct
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    abstract public function getQualityAdjust(): Int;

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
        $this->item->quality = $quality;

        // The Quality of an item is never more than 50
        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        }

        // The Quality of an item is never negative
        if ($this->item->quality < 0) {
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
         * @todo check, may be corrupted (case failed)
         * @todo refine, may be negative? if ($item->sell_in > 0) {}
         */
        $sellIn = $this->getSellIn();
        $sellIn--;

        $this->setSellIn($sellIn);
    }

    /**
     * Update quality by adjust
     */
    public function updateQuality()
    {
        $quality = $this->getQuality();
        $adjust  = $this->getQualityAdjust();

        // do not update quality if no $adjust
        if( $adjust ) {
            $this->setQuality($quality + $adjust);
        }
    }
}