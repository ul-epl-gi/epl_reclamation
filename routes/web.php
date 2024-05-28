<?php

use App\Http\Controllers\TelegramBotController;
use App\Models\Specialty;
use App\Models\TeachingUnit;
use App\Services\Telegram\StartCommand;
use Illuminate\Support\Facades\Route;
use  Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    $response = Telegram::getWebhookInfo();
     //Specialty::find(1)->teachingUnits()->attach(1, ['semester'=> 2]);
    //$response = Specialty::find(1)->teachingUnits()->where('semester', 2)->get();
    return $response;
});

Route::post('/telegram/bot', [TelegramBotController::class, 'getUpdates'])->name('TELEGRAM-BOT');
Route::get('/telegram/eu-list/{specialtyId}/{semester}', [TelegramBotController::class, 'sendList'])->name('TELEGRAM-UE-LIST');
