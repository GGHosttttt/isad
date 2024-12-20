<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
class BookController extends Controller
{
    public function create()
    {

    }
    public function store(StoreBookRequest $request)
    {
        $book = Book::create(attributes: $request->validated());
        $book->save();

        return response()->json([
            'success' => true,
            'data' => BookResource::make($book),
        ], 200);
    }

    public function show($id)
    {
        // Attempt to find the task by ID
        $book = Book::find($id);

        // Handle case when the task is not found
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        // Return the task as a resource
        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ], 200);
    }
    public function destroy($id)
    {
        $book = Book::find($id);

        // Handle case when the task is not found
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        $book->delete();
        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ], 200);
    }


    public function destroyAll()
    {
        try {
            Book::truncate();
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

    public function update(UpdateBookRequest $request, Book $book)
    {
        try {

            $book->fieldId = $request->input('fieldId');
            $book->username = $request->input('username');
            $book->phoneNumber = $request->input('phoneNumber');
            $book->time = $request->input('time');
            $book->date = $request->input('date');
            $book->message = $request->input('message');
            $book->status = $request->input('status');

            if ($book->save()) {
                Log::info('Book updated successfully.');
            } else {
                Log::error('Failed to update book.');
            }

            return response()->json([
                'success' => true,
                'data' => BookResource::make($book),
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the task.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }


    public function index()
    {
        return BookResource::collection(Book::all());
    }
}
