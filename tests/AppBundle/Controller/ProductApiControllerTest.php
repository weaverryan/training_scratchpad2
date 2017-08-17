<?php

namespace Tests\AppBundle\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ProductApiControllerTest extends TestCase
{
    public function testPOSTCreateProduct()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:9008'
        ]);

        $name = 'New product '.rand();
        $data = [
            'name' => $name,
            'price' => rand(10, 100),
            'description' => 'Lorem Ipsum',
        ];
        $response = $client->post('/api/products', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals($name, $data['name']);
        $this->assertNotNull($data['id']);
    }

    public function testGETSingleProduct()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:9008'
        ]);

        $response = $client->get('/api/products/8');

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Amazon Echo', $data['name']);
        $this->assertArrayHasKey('salesPrice', $data);
    }
}
