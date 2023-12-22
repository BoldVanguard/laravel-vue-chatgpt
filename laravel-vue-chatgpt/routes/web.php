<?php

use App\Http\Controllers\CodeExplainer;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ImageGenerator;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // chatbot
    Route::get('chatbot', function () {
        return Inertia::render('Chatbot', [
            'nameInitial' => auth()->user()->name_initial,
        ]);
    })->name('chatbot');
    Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');

    // image generator
    Route::get('image-generator', function () {
        return Inertia::render('ImageGenerator');
    })->name('image-generator');
    Route::post('image-generator', ImageGenerator::class)->name('generate-image');

    // code explainer
    Route::get('code-explainer', function () {
        return Inertia::render('CodeExplainer');
    })->name('code-explainer');
    Route::post('code-explainer', CodeExplainer::class)->name('explain-code');
});
