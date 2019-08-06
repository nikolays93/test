<?php

namespace App;

final class GildedRose {

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    /**
     * Item name equal $req
     * @param  Item   $item
     * @param  String $req  search name
     * @return bool         is matched
     */
    static public function nameMath(Item $item, $req = '')
    {
        return false !== preg_match('/('. $req .')/ui', $item);
    }

    /**
     * Decrase sell in property
     * @param  Item   $item
     * @return Item   $item
     */
    static private function updateSellIn(Item $item)
    {
        /**
         * @property sell_in
         *           @todo check, may be corrupted (case failed)
         *           @todo refine, may be negative? if ($item->sell_in > 0) {}
         */
        $item->sell_in -= 1;

        return $item;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            if (static::nameMath($item, 'Sulfuras')) {
                $item->quality = 80;
                continue;
            }

            if (static::nameMath($item, 'Backstage passes')) {
                // Quality increases by 2 when there are 10 days or less
                if ($item->sell_in <= 10) {
                    $item->quality += 2;
                }
                // Quality increases by 3 when there are 5 days or less
                elseif ($item->sell_in <= 5) {
                    $item->quality += 3;
                }

                else {
                    $item->quality++;
                }
            }

            $item = static::updateSellIn($item);

            // "Aged Brie" actually increases in Quality the older it gets
            // @todo refine, increases after sell_in < 0 only
            if (static::nameMath($item, 'Aged Brie')) {
                $item->quality++;

                if($item->sell_in < 0) {
                    $item->quality++;
                }
            } elseif (!static::nameMath($item, 'Backstage passes')) {
                // The Quality of an item is never negative
                if ($item->quality > 0) {
                    $item->quality--;
                }
            }

            if ($item->sell_in < 0) {
                if (!static::nameMath($item, 'Aged Brie') && !static::nameMath($item, 'Backstage passes')) {
                    // The Quality of an item is never negative
                    if ($item->quality > 0) {
                        $item->quality--;
                    }
                }
            }

            // The Quality of an item is never more than 50
            if( $item->quality > 50 ) {
                $item->quality = 50;
            }

            // Quality drops to 0 after the concert
            if (static::nameMath($item, 'concert')) {
                $item->quality = 0;
            }
        }
    }
}

