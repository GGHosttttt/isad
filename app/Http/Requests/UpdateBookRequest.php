<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends StoreBookRequest
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
            'fieldId' => 'required|numeric',
            'username' => 'required|string|max:255',
            'phoneNumber' => 'required|regex:/^0[1-9]{1}[0-9]{7,8}$/',
            'time' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'message' => 'string|max:255',
            'status' => 'required|numeric|in:0,1,2',
        ];
    }
}
