<?php

use App\Http\Controllers\TelegramBotController;
use App\Services\Telegram\StartCommand;
use Illuminate\Support\Facades\Route;
use  Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    $response = Telegram::getWebhookInfo();
    return $response;
});

Route::post('/telegram/bot', [TelegramBotController::class, 'getUpdates'])->name('TELEGRAM-BOT');
Route::get('/telegram/eu-list', [TelegramBotController::class, 'sendList'])->name('TELEGRAM-UE-LIST');