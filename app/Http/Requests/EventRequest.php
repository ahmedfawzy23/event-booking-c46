<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        if ($this->routeIs('events.update')) {
            return [
                'name' => ['sometimes', 'string', 'max:255'],
                'description' => ['sometimes', 'string', 'max:255'],
                'location' => ['sometimes', 'string', 'max:255'],
                'start_date' => ['sometimes', 'date'],
                'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
                'capacity' => ['sometimes', 'integer', 'max:1000'],
                'available_seats' => ['sometimes', 'integer', 'max:1000', 'lte:capacity'],
                'price' => ['sometimes', 'decimal:2'],
                'image' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
                'status' => ['sometimes', 'in:upcoming,ongoing,completed'],
                'category_id' => ['sometimes', 'exists:categories,id'],
            ];
        }


        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'capacity' => ['required', 'integer', 'max:1000'],
            'available_seats' => ['required', 'integer', 'max:1000', 'lte:capacity'],
            'price' => ['required', 'decimal:2'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
