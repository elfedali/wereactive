<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $slug = $this->faker->slug;
        $on_sale = $this->faker->boolean;
        $is_featured = $this->faker->boolean;
        $active = $this->faker->boolean;

        $response = $this->post(route('product.store'), [
            'slug' => $slug,
            'on_sale' => $on_sale,
            'is_featured' => $is_featured,
            'active' => $active,
        ]);

        $products = Product::query()
            ->where('slug', $slug)
            ->where('on_sale', $on_sale)
            ->where('is_featured', $is_featured)
            ->where('active', $active)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', $product));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $product = Product::factory()->create();
        $slug = $this->faker->slug;
        $on_sale = $this->faker->boolean;
        $is_featured = $this->faker->boolean;
        $active = $this->faker->boolean;

        $response = $this->put(route('product.update', $product), [
            'slug' => $slug,
            'on_sale' => $on_sale,
            'is_featured' => $is_featured,
            'active' => $active,
        ]);

        $product->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($slug, $product->slug);
        $this->assertEquals($on_sale, $product->on_sale);
        $this->assertEquals($is_featured, $product->is_featured);
        $this->assertEquals($active, $product->active);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertNoContent();

        $this->assertModelMissing($product);
    }
}
