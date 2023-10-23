<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'on_sale' => $this->on_sale,
            'sale_price' => $this->sale_price,
            'sale_start' => $this->sale_start,
            'sale_end' => $this->sale_end,
            'is_featured' => $this->is_featured,
            'active' => $this->active,
            'categories' => CategoryCollection::make($this->whenLoaded('categories')),
            'favorites' => FavoriteCollection::make($this->whenLoaded('favorites')),
        ];
    }
}
