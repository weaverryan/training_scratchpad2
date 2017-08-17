<?php

namespace AppBundle\Service;

use AppBundle\Model\Product;
use Psr\Log\LoggerInterface;

class ProductRepository
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

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

        $this->logger
            ->debug(sprintf('Found %d products', count($products)));

        return $products;
    }

    /**
     * @param $id
     * @return Product|null
     */
    public function findOne($id) : ?Product
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (false === $row) {
            return null;
        }

        return $this->hydrateProduct($row);
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