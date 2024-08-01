<?php

use App\Http\Controllers\ApiTaskController;
use App\Http\Controllers\MateController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::delete('/tasks/{task}', [ApiTaskController::class, 'deleteTask']);
Route::get('users/{user}/tasks', [ApiTaskController::class, 'getUserTasks']);
Route::put('tasks/{task}', [ApiTaskController::class, 'updateTask']);
Route::get('/tasks', [ApiTaskController::class, 'index']);
Route::get("/suma/{num1}/{num2}",[MateController::class, 'suma']);
Route::get("/mult/{num1}/{num2}",[MateController::class, 'multiplicacion']);
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});