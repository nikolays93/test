<?php

namespace App;

use App\Exceptions\adjustQualityNotDefinedException;
use App\Traits\SellIn;
use App\Interfaces\IProduct;
use App\Interfaces\Adjustments;

/**
 * change quality by adjust param
 */
abstract class ProductAdjustable extends Product implements IProduct, Adjustments
{
    use SellIn;

    private static $adjustQuality = null;

    function getQualityAdjust(): float
    {
        if ( ! isset(static::$adjustQuality) || null === static::$adjustQuality) {
            throw new adjustQualityNotDefinedException(get_called_class());
        }

        return static::$adjustQuality;
    }

    /**
     * Update quality by adjust
     */
    function updateQuality()
    {
        $newQuality = $this->getQuality();
        $adjust     = $this->getQualityAdjust();

        $newQuality += $adjust;
        // Once the sell by date has passed, Quality (de)grades twice as fast
        if ($this->getSellIn() <= 0) {
            $newQuality += $adjust;
        }

        $this->setQuality($newQuality);
    }
}
