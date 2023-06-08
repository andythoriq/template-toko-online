<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'max:191'],
            "image" => ['nullable', 'image', 'max:5000', 'mimes:png,jpg,jpeg'],
            "desc" => ['required', 'string', 'max:255'],
            "price" => ['required', 'integer'],
            "stock" => ['required', 'integer'],
            "category_id" => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}