<?php

namespace App\Http\Controllers;

use App\Services\Caching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use  Telegram\Bot\Laravel\Facades\Telegram;


class TelegramBotController extends Controller
{

    public function getUpdates(Request $request)
    {
        $update = Telegram::commandsHandler(true);
        $message = $update['message']['text'];

        #Verify that the message is not a command
        if (!strpos($message, '/')) {
            Caching::update($update['message']);
        }
    }
}
