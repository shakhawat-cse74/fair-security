<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Traits\ApiResponse;

class ContactController extends Controller
{

    use ApiResponse;

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string|max:255',
                'service_type' => 'required|string|max:255',
                'message' => 'nullable|string|max:10000',
            ]);

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
            return $this->errorResponse('Failed to submit contact message.', 500);
        }
    }
}
