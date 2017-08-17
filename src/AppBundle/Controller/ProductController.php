<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     */
    public function indexAction()
    {
        $pdo = $this->getPDO();

        $results = $pdo->query('SELECT * FROM product');

        return $this->render('product/index.html.twig', [
            'products' => $results
        ]);
    }

    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $this->render('product/show.html.twig', [
            'product' => $row
        ]);
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
}