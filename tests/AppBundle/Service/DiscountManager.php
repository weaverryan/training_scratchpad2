<?php

namespace Tests\AppBundle\Service;

use AppBundle\Model\Product;
use AppBundle\Service\DiscountManager;
use PHPUnit\Framework\TestCase;

class DiscountManagerTest extends TestCase
{
    /**
     * @dataProvider getPriceTests
     */
    public function testGetDiscountedPrice($productPrice, $expectedDiscountedPrice)
    {
        $discountManager = new DiscountManager();

        $product = new Product();
        $product->setPrice($productPrice);

        $this->assertEquals($expectedDiscountedPrice, $discountManager->getDiscountedPrice($product));
    }

    public function getPriceTests()
    {
        $tests = [];
        $tests[] = [30, 27];
        $tests[] = [120, 96];
        $tests[] = [200, 140];

        return $tests;
    }
}