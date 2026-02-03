<?php

use App\Http\Controllers\Ai\ChatController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/chat');
Route::get('/chat', [ChatController::class, 'create'])->name('chatbot');
Route::post('/chat', [ChatController::class, 'chat'])->name('chatbot.send');
