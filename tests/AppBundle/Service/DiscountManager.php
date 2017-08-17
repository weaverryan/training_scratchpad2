<?php

namespace Tests\AppBundle\Service;

use AppBundle\Model\Product;
use AppBundle\Service\DiscountManager;
use AppBundle\Service\ProductRepository;
use PHPUnit\Framework\TestCase;

class DiscountManagerTest extends TestCase
{
    /**
     * @dataProvider getPriceTests
     */
    public function testGetDiscountedPrice($productPrice, $expectedDiscountedPrice)
    {
        $productRepo = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $discountManager = new DiscountManager($productRepo);

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
        $tests[] = [500, 250];

        return $tests;
    }
}