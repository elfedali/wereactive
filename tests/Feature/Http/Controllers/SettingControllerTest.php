<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SettingController
 */
class SettingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $settings = Setting::factory()->count(3)->create();

        $response = $this->get(route('setting.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SettingController::class,
            'store',
            \App\Http\Requests\SettingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $key = $this->faker->word;

        $response = $this->post(route('setting.store'), [
            'key' => $key,
        ]);

        $settings = Setting::query()
            ->where('key', $key)
            ->get();
        $this->assertCount(1, $settings);
        $setting = $settings->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $setting = Setting::factory()->create();

        $response = $this->get(route('setting.show', $setting));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SettingController::class,
            'update',
            \App\Http\Requests\SettingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $setting = Setting::factory()->create();
        $key = $this->faker->word;

        $response = $this->put(route('setting.update', $setting), [
            'key' => $key,
        ]);

        $setting->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($key, $setting->key);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $setting = Setting::factory()->create();

        $response = $this->delete(route('setting.destroy', $setting));

        $response->assertNoContent();

        $this->assertModelMissing($setting);
    }
}
