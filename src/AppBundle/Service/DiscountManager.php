<?php

namespace AppBundle\Service;

use AppBundle\Model\Product;

class DiscountManager
{
    public function getDiscountedPrice(Product $product)
    {
        if ($product->getPrice() < 100) {
            return $product->getPrice() * .9;
        }

        if ($product->getPrice() < 200) {
            return $product->getPrice() * .8;
        }

        return $product->getPrice() * .7;
    }
}