<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;

class ContactController extends Controller
{

    use ApiResponse;

    public function store(ContactRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $contact = Contact::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'] ?? null,
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'] ?? null,
                'service_type' => $validatedData['service_type'],
                'message' => $validatedData['message'] ?? null,
            ]);

            return $this->successResponse($contact, 'Contact message submitted successfully.', 200);
        } catch (\Exception $e) {
            \Log::error('Contact store error: ' . $e->getMessage());
            return $this->errorResponse('Failed to submit contact message.', 500);
        }
    }
}
