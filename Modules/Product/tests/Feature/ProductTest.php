<?php

namespace Modules\Product\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected array $productJsonStructure = [
        'id',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
        'currency' => [
            'id',
            'code',
            'name',
            'symbol',
        ],
        'category' => [
            'id',
            'name',
            'slug',
        ],
    ];

    /**
     * Test Success get list of products
     *
     * @return void
     */
    public function test_get_list_products_success()
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->productJsonStructure,
                ],
                'meta' => [
                    'page',
                    'per_page',
                    'total',
                    'total_pages',
                ],
            ]);
    }

    /**
     * Test register of user
     *
     * @return void
     */
    public function test_get_by_not_exists_page_products_success()
    {
        $response = $this->getJson('/api/products?'.http_build_query([
            'page' => 12,
            'perPage' => 200,
        ])
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'meta' => [
                    'page',
                    'per_page',
                    'total',
                    'total_pages',
                ],
            ])->assertJson([
                'meta' => [
                    'page' => 12,
                    'per_page' => 200,
                ],
            ])->assertJsonCount(0, 'data');
    }
}
