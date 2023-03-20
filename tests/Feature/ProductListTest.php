<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductListTest extends TestCase
{
    /**
     * @test
     */
    public function canRetrieveProductOfOneCategory()
    {
        $idCategory = 5;
        $response = $this->get("/api/v1/products?idCategory=$idCategory");
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /**
     * @test
     */
    public function canRetrieveProductsWithoutCategory()
    {
        $response = $this->get("/api/v1/products");
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
