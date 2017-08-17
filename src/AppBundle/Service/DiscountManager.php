<?php

namespace AppBundle\Service;

use AppBundle\Model\Product;

class DiscountManager
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getDiscountedPrice(Product $product)
    {
        $mostExpensivePrice = $this->productRepository
            ->getMostExpensivePrice();

        // no discount for most expensive... ever
        if ($product->getPrice() == $mostExpensivePrice) {
            return $product->getPrice();
        }

        if ($product->getPrice() < 100) {
            return $product->getPrice() * .9;
        }

        if ($product->getPrice() < 200) {
            return $product->getPrice() * .8;
        }

        if ($product->getPrice() == 500) {
            return 250;
        }

        return $product->getPrice() * .7;
    }
}