<?php

namespace App;

use App\Product\DefaultProduct;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    public function defaultItemsDataClassNameProvider()
    {
        $itemName      = 'UndefinedName';
        $exceptedClass = DefaultProduct::class;

        return array(
            array($itemName, $exceptedClass, 1, 1, 0, 0),
            array($itemName, $exceptedClass, 0, 10, -1, 8),
            array($itemName, $exceptedClass, -5, 10, -6, 8),
            array($itemName, $exceptedClass, 1, 0, 0, 0),
            array($itemName, $exceptedClass, -5, 0, -6, 0),
        );
    }

    /**
     * @dataProvider defaultItemsDataClassNameProvider
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

        $this->assertEquals($className, get_class($item));
        $this->assertEquals($exceptionSellIn, $item->getSellIn());
        $this->assertEquals($exceptionQuality, $item->getQuality());
    }
}
