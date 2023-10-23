<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ShopController
 */
class ShopControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $shops = Shop::factory()->count(3)->create();

        $response = $this->get(route('shop.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShopController::class,
            'store',
            \App\Http\Requests\ShopStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $slug = $this->faker->slug;

        $response = $this->post(route('shop.store'), [
            'slug' => $slug,
        ]);

        $shops = Shop::query()
            ->where('slug', $slug)
            ->get();
        $this->assertCount(1, $shops);
        $shop = $shops->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $shop = Shop::factory()->create();

        $response = $this->get(route('shop.show', $shop));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShopController::class,
            'update',
            \App\Http\Requests\ShopUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $shop = Shop::factory()->create();
        $slug = $this->faker->slug;

        $response = $this->put(route('shop.update', $shop), [
            'slug' => $slug,
        ]);

        $shop->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($slug, $shop->slug);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $shop = Shop::factory()->create();

        $response = $this->delete(route('shop.destroy', $shop));

        $response->assertNoContent();

        $this->assertModelMissing($shop);
    }
}
