<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CategoryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->routeIs('categories.update')) {
            return [
                'name' => 'required|string|unique:categories,name,' . $this->category->id,
                'description' => 'required|string',
            ];
        }
        return [
            'name' => 'required|string|unique:categories',
            'description' => 'required|string',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'The name is required ya m3alem!',
            'description.required' => 'The description is required ya m3alem!',
        ];
    }
}
