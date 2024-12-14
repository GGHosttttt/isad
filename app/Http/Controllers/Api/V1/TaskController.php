<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return TaskResource::make($task);

    }
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }
    public function destroy(Task $task)
    {
        try {
            // Check if task exists before trying to delete it
            if (!$task) {
                return response()->json(['error' => 'Task not found.'], 404);
            }
            $task->delete();

            return response()->json([
                'message' => 'Task deleted successfully.',
                'task_id' => $task->id,
            ], 200);

        } catch (\Exception $e) {
            // Return error message and exception details for debugging
            return response()->json([
                'error' => 'Failed to delete the task.',
                'details' => $e->getMessage(), // Include exception message for debugging
            ], 500);
        } 
    }


    // public function destory(Task $task)
    // {
    //     $task->delete();

    //     // return TaskResource::make($task);
    //     return response()->noContent();
    //     // return response("Delete Success",200);
    // }

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
