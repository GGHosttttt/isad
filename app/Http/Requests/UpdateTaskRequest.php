<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends StoreTaskRequest
{
    // Optional: You can also modify authorization rules if needed
    public function authorize(): bool
    {
        return true; // Make sure this is set to true if you're not restricting access
    }
    
    public function rules(): array
    {
        // Override the rules for updating a task
        return [
            'name' => 'sometimes|string|max:255', // 'sometimes' allows this field to be optional
            'detail' => 'sometimes|string', // Optional for update
            'price' => 'sometimes|numeric|min:0', // Optional for update
            'bookStatus' => 'sometimes|numeric|in:0,1,2', // Optional for update
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
        ];
    }


}

