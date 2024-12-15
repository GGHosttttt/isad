<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $task = Task::create($request->validated());
        if ($request->hasFile('image')) {
            // Store the image in the 'uploads' directory (public disk)
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Update the task with the image path
            $task->image = $imagePath;
            $task->save(); // Save the task with the updated image path
        }
        return TaskResource::make($task);
    }
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }


    public function destroy(Task $task)
    {
        try {
            // Check if the task has an associated image and delete it
            if ($task->image && Storage::exists('public/' . $task->image)) {
                Storage::delete('public/' . $task->image);
            }

            // Delete the task record from the database
            $task->delete();

            // Return a success response
            return response()->json([
                'message' => 'Task deleted successfully.',
                'task_id' => $task->id,
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'error' => 'Failed to delete the task.',
                'details' => $e->getMessage(),
            ], 500);
        }
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
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function index()
    {
        return TaskResource::collection(Task::all());
    }
}
