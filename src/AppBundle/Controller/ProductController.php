<?php

namespace AppBundle\Controller;

use AppBundle\Model\Product;
use AppBundle\Service\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     */
    public function indexAction()
    {
        $productRepo = new ProductRepository();
        $products = $productRepo->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction($id)
    {
        $productRepo = new ProductRepository();
        $product = $productRepo->findOne($id);

        if (!$product) {
            throw $this->createNotFoundException('No product for id '.$id);
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}