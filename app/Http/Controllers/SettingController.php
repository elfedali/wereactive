<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Http\Resources\SettingCollection;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function index(Request $request): SettingCollection
    {
        $settings = Setting::all();

        return new SettingCollection($settings);
    }

    public function store(SettingStoreRequest $request): SettingResource
    {
        $setting = Setting::create($request->validated());

        return new SettingResource($setting);
    }

    public function show(Request $request, Setting $setting): SettingResource
    {
        return new SettingResource($setting);
    }

    public function update(SettingUpdateRequest $request, Setting $setting): SettingResource
    {
        $setting->update($request->validated());

        return new SettingResource($setting);
    }

    public function destroy(Request $request, Setting $setting): Response
    {
        $setting->delete();

        return response()->noContent();
    }
}
