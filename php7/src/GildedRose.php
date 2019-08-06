<?php

namespace App;

use App\Product\AgedBrie;
use App\Product\BackstagePasses;
use App\Product\Conjured;
use App\Product\Sulfuras;

final class GildedRose
{
    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    /**
     * Item name equal $req
     * @param  String $req  search name
     * @return bool         is matched
     */
    public static function matchName(Item $item, $req = '')
    {
        return (bool) preg_match('/' . $req . '/ui', $item->name);
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            if (static::matchName($item, 'Sulfuras')) {
                $Product = new Sulfuras($item);
            }
            else if(static::matchName($item, 'Backstage passes')) {
                $Product = new BackstagePasses($item);
            }
            else if(static::matchName($item, 'Aged Brie')) {
                $Product = new AgedBrie($item);
            }
            else if(static::matchName($item, 'Conjured')) {
	            $Product = new Conjured($item);
            }
            else {
                $Product = new Product($item);
            }

            $Product->updateQuality();
            $Product->updateSellIn();

            // Quality drops to 0 after the concert
            if (static::matchName($item, 'concert')) {
                // $Product->setQuality(0);
            }
        }
    }
}
