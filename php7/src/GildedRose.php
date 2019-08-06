<?php

namespace App;

final class GildedRose {

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                $item->quality = 80;
                continue;
            }

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->sell_in <= 10) {
                    $item->quality++;
                }
                if ($item->sell_in <= 5) {
                    $item->quality++;
                }

                // realy?
                $item->quality = 0;
            }

            if ($item->name == 'Aged Brie' || $item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality < 50) {
                    $item->quality++;
                }
            } else {
                if ($item->quality > 0) {
                    $item->quality--;
                }
            }

            $item->sell_in--;

            if ($item->sell_in < 0) {
                if ($item->name == 'Aged Brie') {
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                }

                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            $item->quality--;
                        }
                    } else {
                        $item->quality = 0;
                    }
                }
            }
        }
    }
}

