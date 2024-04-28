<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateMessageController;
use App\Http\Controllers\CreateNewsletterController;
use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\GenerateTokenController;
use App\Http\Controllers\GetMessagesController;
use App\Http\Controllers\GetSubscriptionsController;

Route::post('tokens', GenerateTokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    // User
    Route::post('/users', CreateUserController::class);
    // Newsletter && Subscription && Messages
    Route::post('/newsletters', CreateNewsletterController::class);
    Route::post('/newsletters/{id}/subscriptions', CreateSubscriptionController::class);
    Route::get('/newsletters/{id}/subscriptions', GetSubscriptionsController::class);
    Route::get('/newsletters/{id}/messages', GetMessagesController::class);
    Route::post('/newsletters/{id}/messages', CreateMessageController::class);
});
