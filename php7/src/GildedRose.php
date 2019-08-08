<?php

namespace App;

use App\Product\AgedBrie;
use App\Product\BackstagePasses;
use App\Product\Conjured;
use App\Product\DefaultProduct;
use App\Product\Sulfuras;

final class GildedRose
{
    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Sulfuras, Hand of Ragnaros':
                    $Product = new Sulfuras($item);
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    $Product = new BackstagePasses($item);
                    break;

                case 'Aged Brie':
                    $Product = new AgedBrie($item);
                    break;

                case 'Conjured Mana Cake':
                    $Product = new Conjured($item);
                    break;

                default:
                    $Product = new DefaultProduct($item);
                    break;
            }

            $Product->updateQuality();
            $Product->updateSellIn();
        }
    }
}
