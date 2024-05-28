<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
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
        info($update);
        $message = $update['message']['text'];

        #Verify that the message is not a command
        if (!strpos($message, '/')) {
            info($message);
            info($update);
            Caching::update($update['message']);
        }
    }

    public function sendList($specialtyId, $semester)
    {

        $specialty = Specialty::findOrFail($specialtyId);
        $teachingUnits = $specialty->teachingUnits()->where('semester', $semester)->get();
        return view('ue_list', ['teachingUnits' => $teachingUnits]);
    }
}
