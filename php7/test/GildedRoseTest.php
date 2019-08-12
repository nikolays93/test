<?php

namespace App;

use App\Product\AgedBrie;
use App\Product\BackstagePasses;
use App\Product\Conjured;
use App\Product\DefaultProduct;
use App\Product\Sulfuras;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string $itemName
     * @param string $exceptedClass
     * @param array $rawArray [
            float $sellIn,
            float $quality,
            float $exceptionSellIn,
            float $exceptionQuality]
     *
     * @return array $preparedArray
     */
    private function combineArrayProvider(string $itemName, string $exceptedClass, array $rawArray): array
    {
        /**
         * Prepare for exclude copy-paste
         *
         * array($itemName, $exceptedClass, 1, 1, 0, 0),
         * array($itemName, $exceptedClass, 0, 10, -1, 8) ...
         */
        return array_map(function ($preparedArray) use ($itemName, $exceptedClass) {
            array_unshift($preparedArray, $itemName, $exceptedClass);

            return $preparedArray;
        }, $rawArray);
    }

    public function DefaultItemDataProvider()
    {
        return self::CombineArrayProvider( 'UndefinedName', DefaultProduct::class, array(
            // At the end of each day our system lowers both values for every item
            array(1, 1, 0, 0),
            // Once the sell by date has passed,...
            array(-5, 10, -6, 8),
            // Quality degrades twice as fast
            array(0, 10, -1, 8),
            // The Quality of an item is never negative
            array(1, 0, 0, 0),
            array(-5, 0, -6, 0),
            // The Quality of an item is never more than 50
            array(1, 80, 0, 50),
        ) );
    }

    public function AgedBrieItemDataProvider()
    {
        return self::CombineArrayProvider( 'Aged Brie', AgedBrie::class, array(
            // "Aged Brie" actually increases in Quality the older it gets
            array(1, 10, 0, 11),
            array(0, 10, -1, 12),
            array(-1, 12, -2, 14),
            array(-1, 80, -2, 50),
            array(-2, 50, -3, 50),
            array(-3, 49, -4, 50),
        ) );
    }

    public function SulfurasItemDataProvider()
    {
        return self::CombineArrayProvider( 'Sulfuras, Hand of Ragnaros', Sulfuras::class, array(
            // "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
            array(10, 80, 10, 80),
            array(0, 80, 0, 80),
            array(-10, 80, -10, 80),
        ) );
    }

    public function BackstagePassesItemDataProvider()
    {
        return self::CombineArrayProvider( 'Backstage passes to a TAFKAL80ETC concert', BackstagePasses::class, array(
            // "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
            array(20, 10, 19, 11),
            array(20, 50, 19, 50),
            // Quality increases by 2 when there are 10 days or less
            array(11, 20, 10, 21),
            array(10, 20, 9, 22),
            array(10, 49, 9, 50),
            // ..and by 3 when there are 5 days or less but
            array(6, 20, 5, 22),
            array(5, 20, 4, 23),
            array(5, 48, 4, 50),
            array(1, 20, 0, 23),
            // Quality drops to 0 after the concert
            array(0, 5, -1, 0),
            array(-1, 5, -2, 0),
        ) );
    }

    public function ConjureItemDataProvider()
    {
        return self::CombineArrayProvider('Conjured Mana Cake', Conjured::class, array(
            // "Conjured" items degrade in Quality twice as fast as normal items
            array(10, 20, 9, 18),
            // Quality degrades twice as fast
            array(0, 10, -1, 6),
            array(-5, 8, -6, 4),
            // The Quality of an item is never negative
            array(5, 1, 4, 0),
            array(0, 2, -1, 0),
        ));
    }

    /**
     * @dataProvider DefaultItemDataProvider
     * @dataProvider AgedBrieItemDataProvider
     * @dataProvider SulfurasItemDataProvider
     * @dataProvider BackstagePassesItemDataProvider
     * @dataProvider ConjureItemDataProvider
     *
     * @param string $name
     * @param string $className
     * @param float $sellIn
     * @param float $quality
     * @param float $exceptionSellIn
     * @param float $exceptionQuality
     */
    public function testUpdate(
        string $name,
        string $className,
        float $sellIn,
        float $quality,
        float $exceptionSellIn,
        float $exceptionQuality
    ) {
        $exampleItem = new Item($name, $sellIn, $quality);
        $gildedRose  = new GildedRose();
        $gildedRose
            ->add($exampleItem)
            ->build()
            ->update();

        // get once (first) item
        $item = $gildedRose->get();

        /**
         * @todo check class name in uniq test-method
         */
        $this->assertEquals($className, get_class($item));
        $this->assertEquals($exceptionSellIn, $item->getSellIn());
        $this->assertEquals($exceptionQuality, $item->getQuality());
    }
}
