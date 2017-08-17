<?php

namespace AppBundle\Controller;

use AppBundle\Service\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductApiController extends Controller
{
    /**
     * @Route("/api/products", name="api_product_list")
     */
    public function listAction()
    {
        return $this->json(['products' => 'foo']);
    }
}