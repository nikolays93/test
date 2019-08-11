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

    public function __construct($items = array())
    {
        $this->add($items);
    }

    /**
     * Set item objects
     */
    public function build()
    {
        foreach ($this->items as &$item) {
            switch ($item->name) {
                case 'Sulfuras, Hand of Ragnaros':
                    $item = new Sulfuras($item);
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    $item = new BackstagePasses($item);
                    break;

                case 'Aged Brie':
                    $item = new AgedBrie($item);
                    break;

                case 'Conjured Mana Cake':
                    $item = new Conjured($item);
                    break;

                default:
                    $item = new DefaultProduct($item);
                    break;
            }
        }

        return $this;
    }

    /**
     * Update quality and sell in
     */
    public function update()
    {
        foreach ($this->items as $item) {
            $item->updateQuality();
            $item->updateSellIn();
        }

        return $this;
    }

    /**
     * Return all items as array.
     *
     * @return array
     */
    public function fetch()
    {
        return $this->items;
    }

    /**
     * Get element by offset (index)
     *
     * @param $offset
     *
     * @return mixed
     */
    public function get($offset = 0)
    {
        if (isset($this->items[$offset])) {
            return $this->items[$offset];
        }

        return null;
    }

    /**
     * Add item to collection.
     *
     * @param array|object $item
     */
    public function add($item)
    {
        if (is_array($item)) {
            foreach ($item as $i) {
                $this->add($i);
            }
        } else {
            $this->items[] = $item;
        }

        return $this;
    }
}
