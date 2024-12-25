<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactResource::collection(contact::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $book = contact::create(attributes: $request->validated());
        $book->save();

        return response()->json([
            'success' => true,
            'data' => ContactResource::make($book),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Attempt to find the task by ID
        $contact = contact::find($id);

        // Handle case when the task is not found
        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        // Return the task as a resource
        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contact $contact)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = contact::find($id);

        // Handle case when the task is not found
        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $contact->delete();
        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact),
        ], 200);
    }
    public function destroyAll()
    {
        try {
            contact::truncate();
            return response()->json([
                'message' => 'All tasks deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'error' => 'Failed to delete all tasks.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(UpdateContactRequest $request, contact $contact)
    {
        try {
            $contact->email = $request->input('email');
            $contact->phoneNumber = $request->input('phoneNumber');
            $contact->message = $request->input('message');

            $contact->save();

            // Return the updated task as a resource
            return response()->json([
                'success' => true,
                'data' => ContactResource::make($contact),
            ], 200);

        } catch (\Exception $e) {
            // Return a friendly error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the task.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
