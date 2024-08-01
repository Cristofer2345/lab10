<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Task;

class ApiTaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::all(['id', 'name']);
        return response()->json($tasks);
    }
    public function getUserTasks(int $userId): JsonResponse
    {
        if (Auth::user()->id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $tasks = Task::where('user_id', $userId)->get(['id', 'name']);
        return response()->json($tasks);
    }
    public function updateTask(Request $request, Task $task): JsonResponse
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string'
        ,
    ]);

    $task->update($validatedData);

    return response()->json($task);
}
public function deleteTask(Request $request, Task $task): JsonResponse
{
    
    $task->delete();

    
    return response()->json(['message' => 'Task deleted successfully.']);
} 
}
