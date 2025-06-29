<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle']);
});
