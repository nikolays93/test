<?php

namespace App;

Interface Adjustments
{
    function getQualityAdjust(): int;
    function getSellInAdjust(): int;
}

/**
 * change quality by adjust param
 */
abstract class ProductAdjustable extends Product implements IProduct // , Adjustments
{
    use SellIn;

    /**
     * Update quality by adjust
     */
    function updateQuality()
    {
        $newQuality = $this->getQuality();
        $adjust = $this->getQualityAdjust();

        $newQuality += $adjust;
        // Once the sell by date has passed, Quality (de)grades twice as fast
        if ($this->getSellIn() <= 0) {
            $newQuality += $adjust;
        }

        $this->setQuality($newQuality);
    }
}
