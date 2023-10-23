<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'unique:products,slug'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'quantity' => ['nullable', 'integer'],
            'on_sale' => ['required'],
            'sale_price' => ['nullable', 'numeric'],
            'sale_start' => ['nullable'],
            'sale_end' => ['nullable'],
            'is_featured' => ['required'],
            'active' => ['required'],
        ];
    }
}
