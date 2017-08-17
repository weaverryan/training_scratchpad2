<?php

namespace AppBundle\Controller;

use AppBundle\Model\Product;
use AppBundle\Service\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    /**
     * @Route("/api/products", name="api_product_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $productRepo = $this->container->get('app.product_repository');
        $products = $productRepo->findAll();

        $json = $this->container->get('jms_serializer')
            ->serialize($products, 'json');

        return new Response($json);
    }

    /**
     * @Route("/api/products", name="api_product_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setDescription($data['description']);

        $this->container->get('app.product_repository')
            ->save($product);

        $json = $this->container->get('jms_serializer')
            ->serialize($product, 'json');

        return new Response($json, 201);
    }
}