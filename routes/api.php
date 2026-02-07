<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NilaiController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\EmployeeController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/divisions', [DivisionController::class, 'index']);
    // CRUD Employees
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
    // SQL Queries
    Route::get('/nilaiRT', [NilaiController::class, 'nilaiRT']);
    Route::get('/nilaiST', [NilaiController::class, 'nilaiST']);
});
