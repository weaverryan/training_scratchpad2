<?php

namespace AppBundle\Service;

use AppBundle\Model\Product;
use Psr\Log\LoggerInterface;

class ProductRepository
{
    private $logger;
    private $pdo;

    public function __construct(LoggerInterface $logger, \PDO $pdo)
    {
        $this->logger = $logger;
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $pdo = $this->pdo;

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
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (false === $row) {
            return null;
        }

        return $this->hydrateProduct($row);
    }

    public function save(Product $product)
    {
        $stmt = $this->pdo->prepare('INSERT INTO product (name, price, description) VALUES (:name, :price, :description)');
        $stmt->execute([
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
        ]);

        $product->setId($this->pdo->lastInsertId());
    }

    public function getMostExpensivePrice(): float
    {
        $stmt = $this->pdo->prepare('SELECT MAX(price) as maxPrice FROM product');
        $stmt->execute();

        return $stmt->fetchColumn(0);
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