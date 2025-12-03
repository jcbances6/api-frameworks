<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_the_list_of_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function it_creates_a_new_product()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => 'Laptop HP',
            'description' => 'Modelo i5',
            'price' => 2500,
            'category_id' => $category->id
        ];

        $response = $this->postJson('/api/v1/products', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Laptop HP']);

        $this->assertDatabaseHas('products', [
            'name' => 'Laptop HP',
            'category_id' => $category->id
        ]);
    }

    #[Test]
    public function product_requires_positive_price()
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/v1/products', [
            'name' => 'TV LG',
            'price' => -10,
            'category_id' => $category->id
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['price']);
    }

    #[Test]
    public function it_updates_a_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->putJson("/api/v1/products/{$product->id}", [
            'name' => 'Laptop Actualizada',
            'price' => 2999,
            'category_id' => $category->id
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Laptop Actualizada']);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Laptop Actualizada'
        ]);
    }

    #[Test]
    public function it_deletes_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/v1/products/{$product->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
