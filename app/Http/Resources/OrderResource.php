<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'shop_id' => $this->shop_id,
            'status' => $this->status,
            'shipping_address' => $this->shipping_address,
            'shipping_phone' => $this->shipping_phone,
            'shipping_email' => $this->shipping_email,
            'shipping_name' => $this->shipping_name,
            'shipping_city' => $this->shipping_city,
            'shipping_country' => $this->shipping_country,
            'shipping_zip' => $this->shipping_zip,
            'shipping_state' => $this->shipping_state,
            'shipping_indications' => $this->shipping_indications,
            'tax' => $this->tax,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'orderItems' => OrderItemCollection::make($this->whenLoaded('orderItems')),
        ];
    }
}
