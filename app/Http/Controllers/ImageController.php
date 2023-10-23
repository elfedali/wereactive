<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function index(Request $request): ImageCollection
    {
        $images = Image::all();

        return new ImageCollection($images);
    }

    public function store(ImageStoreRequest $request): ImageResource
    {
        $image = Image::create($request->validated());

        return new ImageResource($image);
    }

    public function show(Request $request, Image $image): ImageResource
    {
        return new ImageResource($image);
    }

    public function update(ImageUpdateRequest $request, Image $image): ImageResource
    {
        $image->update($request->validated());

        return new ImageResource($image);
    }

    public function destroy(Request $request, Image $image): Response
    {
        $image->delete();

        return response()->noContent();
    }
}
