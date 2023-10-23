<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImageController
 */
class ImageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $images = Image::factory()->count(3)->create();

        $response = $this->get(route('image.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'store',
            \App\Http\Requests\ImageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $user = User::factory()->create();
        $path = $this->faker->word;

        $response = $this->post(route('image.store'), [
            'user_id' => $user->id,
            'path' => $path,
        ]);

        $images = Image::query()
            ->where('user_id', $user->id)
            ->where('path', $path)
            ->get();
        $this->assertCount(1, $images);
        $image = $images->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $image = Image::factory()->create();

        $response = $this->get(route('image.show', $image));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'update',
            \App\Http\Requests\ImageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $image = Image::factory()->create();
        $user = User::factory()->create();
        $path = $this->faker->word;

        $response = $this->put(route('image.update', $image), [
            'user_id' => $user->id,
            'path' => $path,
        ]);

        $image->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $image->user_id);
        $this->assertEquals($path, $image->path);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $image = Image::factory()->create();

        $response = $this->delete(route('image.destroy', $image));

        $response->assertNoContent();

        $this->assertModelMissing($image);
    }
}
