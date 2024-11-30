<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

// Rutas para la API de notas
Route::apiResource('notes', NoteController::class);
