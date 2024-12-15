<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'detail' => 'required|string', // Allows longer text
            'price' => 'required|numeric|min:0',
            'bookStatus' => 'required|numeric|in:1,2,3', // Restrict to 1, 2, or 3
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

}
