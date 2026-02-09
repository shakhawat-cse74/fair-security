<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|nullable|string|max:255',
            'service_type' => 'sometimes|required|string|max:255',
            'message' => 'sometimes|nullable|string|max:10000',
            'status' => 'sometimes|required|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name field is required.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Phone number is required.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'service_type.required' => 'Service type is required.',
            'message.max' => 'Message cannot exceed 10000 characters.',
            'status.boolean' => 'Status must be true or false.',
        ];
    }
}
