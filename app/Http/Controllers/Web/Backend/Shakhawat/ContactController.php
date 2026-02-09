<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display contacts with DataTables
     */
    public function index()
    {
        return view('backend.layouts.contact.index');
    }

    /**
     * Display a specific contact
     */
    public function show($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            
            // Mark as read if not already
            if (!$contact->status) {
                $contact->update(['status' => 1]);
            }
            
            return view('backend.layouts.contact.show', compact('contact'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contact.index')
                ->with('error', 'Contact not found');
        } catch (\Exception $e) {
            \Log::error('Contact show error: ' . $e->getMessage());
            return redirect()->route('contact.index')
                ->with('error', 'An error occurred while loading the contact');
        }
    }

    /**
     * Show edit form for contact
     */
    public function edit($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            return view('backend.layouts.contact.edit', compact('contact'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contact.index')
                ->with('error', 'Contact not found');
        } catch (\Exception $e) {
            \Log::error('Contact edit error: ' . $e->getMessage());
            return redirect()->route('contact.index')
                ->with('error', 'An error occurred');
        }
    }

    /**
     * Update contact status and other details
     */
    public function update(Request $request, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            
            // Handle AJAX status-only updates
            if ($request->has('status') && !$request->has('name') && !$request->has('email') && !$request->has('phone')) {
                $validated = $request->validate([
                    'status' => 'required|in:0,1',
                ]);
                $contact->update(['status' => (bool) $validated['status']]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully.',
                    'data' => $contact
                ], 200);
            }
            
            // Handle full contact updates
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255',
                'phone' => 'sometimes|required|string|max:20',
                'address' => 'sometimes|nullable|string|max:255',
                'service_type' => 'sometimes|required|string|max:255',
                'message' => 'sometimes|nullable|string|max:10000',
                'status' => 'sometimes|required|in:0,1',
            ]);
            
            // Convert status to boolean if present
            if (isset($validated['status'])) {
                $validated['status'] = (bool) $validated['status'];
            }
            
            $contact->update($validated);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact updated successfully.',
                    'data' => $contact
                ], 200);
            }
            
            return redirect()->route('contact.show', $contact->id)
                ->with('success', 'Contact updated successfully.');
        } catch (ModelNotFoundException $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Contact not found'], 404);
            }
            return redirect()->route('contact.index')->with('error', 'Contact not found');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Contact update error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Failed to update contact'
                ], 500);
            }
            
            return back()->with('error', 'An error occurred while updating the contact');
        }
    }

    /**
     * Delete a contact
     */
    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact deleted successfully.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Contact not found'
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Contact delete error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to delete contact',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark multiple contacts as read
     */
    public function markAsRead(Request $request)
    {
        try {
            // Get ids from JSON body or form data
            $ids = $request->input('ids');
            
            // If ids is a string (JSON), decode it
            if (is_string($ids)) {
                $ids = json_decode($ids, true);
            }
            
            if (empty($ids)) {
                return response()->json(['error' => 'No contacts selected'], 400);
            }
            
            // Ensure ids are integers
            $ids = array_map('intval', $ids);
            
            Contact::whereIn('id', $ids)->update(['status' => 1]);
            
            return response()->json([
                'success' => true,
                'message' => 'Contacts marked as read.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Mark as read error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update contacts', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Get contacts data for API or AJAX with status filtering
     */
    public function getData(Request $request)
    {
        try {
            $query = Contact::select(['id', 'name', 'email', 'phone', 'service_type', 'message', 'status', 'created_at']);
            
            // Filter by status if provided
            if ($request->has('status')) {
                $status = $request->input('status');
                $query->where('status', (int) $status);
            }
            
            $contacts = $query->latest()->get();
            
            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return (int) $row->status;
                })
                ->rawColumns(['status'])
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Get data error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch contacts'
            ], 500);
        }
    }
}
