<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class approveBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Book $book)
    {
        $book->status = $request->status;
        $book->save();

        return BookResource::make($book);
    }
}
