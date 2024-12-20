<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
class TaskController extends Controller
{
    public function create()
    {

    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create(attributes: $request->validated());
        
        if ($request->hasFile('image')) {
            // Store the image in the 'uploads' directory (public disk)
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Update the task with the image path
            $task->image = $imagePath;
            $task->save(); // Save the task with the updated image path
        }
        return response()->json([
            'success' => true,
            'data' => TaskResource::make($task),
        ], 200);
    }

    public function show($id)
    {
        // Attempt to find the task by ID
        $task = Task::find($id);

        // Handle case when the task is not found
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        // Return the task as a resource
        return response()->json([
            'success' => true,
            'data' => new TaskResource($task),
        ], 200);
    }


    public function destroy($id)
    {
        $task = Task::find($id);

        // Handle case when the task is not found
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }

        if ($task->image && Storage::exists('public/' . $task->image)) {
            Storage::delete('public/' . $task->image);
        }
        $task->delete();

        // Return the task as a resource
        return response()->json([
            'success' => true,
            'data' => new TaskResource($task),
        ], 200);
    }

    /**
     * Delete all tasks from storage.
     *
     * @return \Illuminate\Http\Response
     */

    public function destroyAll()
    {
        try {
            // Delete all tasks from the database
            Task::truncate();

            // Optionally, if you want to delete all images associated with tasks
            // You can add additional logic here to remove images, if needed.

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




    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            // Update task with validated data
            // Log::info('Task before update: ' . $task);
            // $task->update($request->validated());
            $task->name = $request->input('name');
            $task->detail = $request->input('detail');
            $task->price = $request->input('price');
            $task->bookStatus = $request->input('bookStatus');

            // Handle image upload if provided
            // if ($request->hasFile('image')) {
            //     $task->image = $this->handleImageUpload($request, $task);
            // }
            // Log::info('Task before update: ' . $task);

            // Handle image upload
            // $task->image = $this->handleImageUpload($request, $task);
            $task->save();

            // Return the updated task as a resource
            return response()->json([
                'success' => true,
                'data' => TaskResource::make($task),
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

    private function handleImageUpload($request, $task)
    {
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($task->image && Storage::disk('public')->exists($task->image)) {
                Storage::disk('public')->delete($task->image);
            }

            // Store the new image
            return $request->file('image')->store('uploads', 'public');
        }

        return $task->image; // Retain old image if no new one is provided
    }




    public function index()
    {
        return TaskResource::collection(Task::all());
    }
}
