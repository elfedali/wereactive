<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'shop_id' => ['required', 'integer', 'exists:shops,id'],
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'shipping_address' => ['nullable', 'string'],
            'shipping_phone' => ['nullable', 'string'],
            'shipping_email' => ['nullable', 'string'],
            'shipping_name' => ['nullable', 'string'],
            'shipping_city' => ['nullable', 'string'],
            'shipping_country' => ['nullable', 'string'],
            'shipping_zip' => ['nullable', 'string'],
            'shipping_state' => ['nullable', 'string'],
            'shipping_indications' => ['nullable', 'string'],
            'tax' => ['nullable', 'numeric'],
            'sub_total' => ['nullable', 'numeric'],
            'total' => ['nullable', 'numeric'],
        ];
    }
}
