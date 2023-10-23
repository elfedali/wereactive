<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FavoriteController
 */
class FavoriteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $favorites = Favorite::factory()->count(3)->create();

        $response = $this->get(route('favorite.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FavoriteController::class,
            'store',
            \App\Http\Requests\FavoriteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('favorite.store'), [
            'user_id' => $user->id,
        ]);

        $favorites = Favorite::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $favorites);
        $favorite = $favorites->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $favorite = Favorite::factory()->create();

        $response = $this->get(route('favorite.show', $favorite));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FavoriteController::class,
            'update',
            \App\Http\Requests\FavoriteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $favorite = Favorite::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('favorite.update', $favorite), [
            'user_id' => $user->id,
        ]);

        $favorite->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $favorite->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $favorite = Favorite::factory()->create();

        $response = $this->delete(route('favorite.destroy', $favorite));

        $response->assertNoContent();

        $this->assertModelMissing($favorite);
    }
}
