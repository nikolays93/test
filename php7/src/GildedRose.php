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

            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    $item->quality--;
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality++;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in < 11) {
                            $item->quality++;
                        }
                        if ($item->sell_in < 6) {
                            $item->quality++;
                        }

                        $item->quality = 0;
                    }
                }
            }

            $item->sell_in--;

            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            $item->quality--;
                        }
                    } else {
                        $item->quality = 0;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                }
            }
        }
    }
}

