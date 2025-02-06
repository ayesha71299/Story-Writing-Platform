<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\NotificationController;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    $stories = \App\Models\Story::with('chapters.user')->get();
    return view('dashboard', compact('stories'));
})->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/stories/create', [StoryController::class, 'create'])->name('stories.create');
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('stories', StoryController::class);
    Route::post('stories/{story}/publish', [StoryController::class, 'publish'])->name('stories.publish');
    Route::post('stories/{story}/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/stories/{story}/chapters/create', [ChapterController::class, 'create'])->name('chapters.create');
    Route::post('/stories/{story}/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/stories/{story}/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
});

require __DIR__.'/auth.php';
