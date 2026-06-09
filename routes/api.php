<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Rotta per la lista completa dei progetti (paginata)
Route::get('/projects', [ProjectController::class, 'index']);

// Rotta per il dettaglio del singolo progetto tramite slug
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
