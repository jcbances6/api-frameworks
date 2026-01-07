<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_the_list_of_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(200)
                    ->assertJsonCount(3);
    }

    #[Test]
    public function it_creates_a_new_category()
    {
        $data = ['name' => 'Electrónica'];

        $response = $this->postJson('/api/v1/categories', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Electrónica']);

        $this->assertDatabaseHas('categories', $data);
    }

    #[Test]
    public function it_requires_category_name()
    {
        $response = $this->postJson('/api/v1/categories', [
            'name' => ''
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }

    #[Test]
    public function it_updates_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/v1/categories/{$category->id}", [
            'name' => 'Actualizado'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Actualizado']);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Actualizado'
        ]);
    }

    #[Test]
    public function it_deletes_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/v1/categories/{$category->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
