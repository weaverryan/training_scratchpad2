<?php

namespace AppBundle\Controller;

use AppBundle\Service\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    /**
     * @Route("/api/products", name="api_product_list")
     */
    public function listAction()
    {
        $productRepo = $this->container->get('app.product_repository');
        $products = $productRepo->findAll();

        $json = $this->container->get('jms_serializer')
            ->serialize($products, 'json');

        return new Response($json);
    }
}