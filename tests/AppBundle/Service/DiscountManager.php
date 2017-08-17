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
    public function testGetDiscountedPrice($productPrice, $mostExpensivePrice, $expectedDiscountedPrice)
    {
        $productRepo = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productRepo->expects($this->any())
            ->method('getMostExpensivePrice')
            ->willReturn($mostExpensivePrice);

        $discountManager = new DiscountManager($productRepo);

        $product = new Product();
        $product->setPrice($productPrice);

        $this->assertEquals($expectedDiscountedPrice, $discountManager->getDiscountedPrice($product));
    }

    public function getPriceTests()
    {
        $tests = [];
        $tests[] = [30, 900, 27];
        $tests[] = [120, 900, 96];
        $tests[] = [200, 900, 140];
        $tests[] = [500, 900, 250];
        $tests['no_discount_most_expensive'] = [500, 500, 500];

        return $tests;
    }
}