<?php

namespace AppBundle\Service;

use AppBundle\Model\Product;

class ProductRepository
{
    public function findAll()
    {
        $pdo = $this->getPDO();

        $stmt = $pdo->prepare('SELECT * FROM product');
        $stmt->execute();
        $results = $stmt->fetchAll();
        $products = [];
        foreach ($results as $row) {
            $products[] = $this->hydrateProduct($row);
        }

        return $products;
    }

    /**
     * @return \PDO
     */
    private function getPDO()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=chicago_training', 'root');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    private function hydrateProduct(array $row)
    {
        $product = new Product();
        $product->setId($row['id']);
        $product->setName($row['name']);
        $product->setPrice($row['price']);
        $product->setDescription($row['description']);

        return $product;
    }
}