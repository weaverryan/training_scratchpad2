<?php

namespace Tests\AppBundle\Service;

use AppBundle\Model\Product;
use AppBundle\Service\DiscountManager;
use PHPUnit\Framework\TestCase;

class DiscountManagerTest extends TestCase
{
    public function testGetDiscountedPrice()
    {
        $discountManager = new DiscountManager();

        $product = new Product();
        $product->setPrice(30);

        $this->assertEquals(27, $discountManager->getDiscountedPrice($product));
    }
}