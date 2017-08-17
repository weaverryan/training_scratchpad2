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
        $pdo = new \PDO('mysql:host=localhost;dbname=chicago_training', 'root');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $results = $pdo->query('SELECT * FROM product');

        return $this->render('product/index.html.twig', [
            'products' => $results
        ]);
    }
}