<?php

use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //home
    Route::get('/', [PollController::class, 'index'])->name('index');

    //poll creation routes
    Route::get('/create_poll', [PollController::class, 'create_Poll']);
    Route::get('/create_image_poll', [PollController::class, 'create_Image_Poll']);
    Route::get('/create_ranking_poll', [PollController::class, 'create_Ranking_Poll']);
    //poll vote routes
    Route::get('/vote_page', [PollController::class, 'vote_Page'])->name('vote_page');
    Route::get('/images_vote_page', [PollController::class, 'images_Vote_Page']);
    Route::get('/multiple_vote_page', [PollController::class, 'multiple_Vote_Page']);
    //poll post routes
    Route::post('/pollsubmit', [PollController::class, 'poll_Submit'])->name('poll_Submit');
    Route::post('/multiple', [PollController::class, 'multiple_Submit']);
    Route::post('/ranking', [PollController::class, 'ranking_Submit']);
    Route::post('/poll', [VoteController::class, 'storePoll']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //poll deletion
    Route::get('/delete_poll/{pollType}/{id}', [PollController::class, 'delete_Poll']);
    //poll edit
    Route::get('/edit_poll/{pollType}/{id}', [PollController::class, 'edit_Poll']);
    Route::put('/update_poll/{pollType}/{id}', [PollController::class, 'update_Poll']);

    Route::get('/NotFound',function(){
        return Inertia::render('not_found');
    });
});

require __DIR__ . '/auth.php';
