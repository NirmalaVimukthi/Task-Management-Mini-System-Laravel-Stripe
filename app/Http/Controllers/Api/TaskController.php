<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['users', 'creator'])->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
            'is_completed' => 'sometimes|boolean',
            'is_paid' => 'sometimes|boolean',
         
        ]);

    
        
        $task = Task::create($validatedData);

        // If user_ids are provided, attach them to the task
        if ($request->has('userIds')) {
            $task->users()->attach($request->userIds);
        }

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    
    }

    // GET /tasks/{id} - Retrieve a specific task
    public function show($id)
    {
        $task = Task::with(['users', 'creator'])->find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
       // return response()->json(['message' => 'Task not found'], 404);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
            'is_completed' => 'sometimes|boolean',
            'is_paid' => 'sometimes|boolean',
         
        ]);

        $task->update($validatedData);

        // If user_ids are provided, sync them with the task
        if ($request->has('userIds')) {
            $task->users()->sync($request->userIds);
        }

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
