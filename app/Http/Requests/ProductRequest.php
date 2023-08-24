<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name
 * @property-read string $description
 * @property-read string $stock
 * @property-read string $price
 * @property-read string $discount
 */
class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|max:10',
            'stock' => 'required|max:6',
            'discount' => 'required|max:2',
        ];
    }
}
