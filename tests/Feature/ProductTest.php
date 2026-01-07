<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_create_a_new_product()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Producto de prueba',
            'description' => 'Descripción de prueba',
            'price' => 100,
            'category_id' => $category->id
        ];

        $response = $this->postJson('/api/v1/products', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Producto de prueba']);

        $this->assertDatabaseHas('products', $data);
    }
}
