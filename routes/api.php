<?php

use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ContributorController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/stories', [StoryController::class, 'store']); // Create a story
    Route::get('/stories', [StoryController::class, 'index']); // List all published stories
    Route::post('/stories/{id}/chapters', [ChapterController::class, 'store']); // Add a chapter to a story
    Route::get('/contributors', [ContributorController::class, 'index']); // List contributors and rankings
// });

