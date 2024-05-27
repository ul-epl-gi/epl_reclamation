<?php

namespace  App\Services;

use App\Models\Reclamation;
use App\Services\Telegram\AnswerManger;
use App\Utils\States;
use Exception;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Laravel\Facades\Telegram;

class Caching
{
    public static function update(array $content)
    {
        $chat_id = $content['chat']['id'];
        Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Choisir les ues concernées',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Choisir les ues concernées',
                            'web_app' => ['url'=> 'https://2dcc-102-64-166-222.ngrok-free.app/telegram/eu-list']
                        ]
                    ]
                ]
            ])
        ]);
        // Telegram::sendMessage(['chat_id' => $chat_id, 'text'=> 'ok']);
        /* $chat_id = $content['chat']['id'];
        $state = 1;
        try {
            if (Cache::has($chat_id)) {
                $reclamation = Cache::get($chat_id);
                $state = $reclamation->state;
                switch ($state) {
                    case  States::ASK_STUDENT_CARD_NUMBER:
                        $reclamation->student_card_number = $content['text'];
                        $reclamation->state = States::ASK_FULL_NAME;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_FULL_NAME, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_FULL_NAME:
                        $names = explode(" ", trim($content['text']));
                        $reclamation->first_name = $names[0];
                        $last_name = "";
                        for ($i = 1; $i < count($names); $i++) {
                            $last_name = $last_name . ' ' . $names[$i];
                        }
                        $reclamation->last_name = $last_name;
                        $reclamation->state = States::ASK_SPECIALTY;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_SPECIALTY, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_SPECIALTY:
                        $reclamation->specialty = $content['text'];
                        $reclamation->state = States::ASK_SEMESTER;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_SEMESTER, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_SEMESTER:
                        $reclamation->semester = $content['text'];
                        $reclamation->state = States::ASK_TEACHING_UNIT_CODE;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_TEACHING_UNIT_CODE, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_TEACHING_UNIT_CODE:
                        $reclamation->teaching_unit_code = $content['text'];
                        $reclamation->state = States::ASK_TEACHING_UNIT_NAME;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_TEACHING_UNIT_NAME, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_TEACHING_UNIT_NAME:
                        $reclamation->teaching_unit_name = $content['text'];
                        $reclamation->state = States::ASK_FILE;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_FILE, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_FILE:
                        $reclamation->file_path = "test";
                        $reclamation->state = States::ASK_CONFIRMATION;
                        Cache::put($chat_id, $reclamation, now()->addDays(5));
                        AnswerManger::sendAnswer(['state' => States::ASK_CONFIRMATION, 'chat_id' => $chat_id]);
                        break;
                    case States::ASK_CONFIRMATION:
                        if (strtolower($content['text']) == "oui") {
                            AnswerManger::sendAnswer(['state' => States::SEND_CONFIRMATION_MESSAGE, 'chat_id' => $chat_id]);
                            Caching::saveInDatabase($reclamation);
                            Cache::forget($chat_id);
                        } else {
                            Cache::forget($chat_id);
                            AnswerManger::sendAnswer(['state' => States::SEND_CANCELLATION_MESSAGE, 'chat_id' => $chat_id]);
                        }
                    default:
                        break;
                }
            } else {
                if ($content['text'] == 'oui') {
                    $reclamation = new Reclamation();
                    $reclamation->chat_id = $chat_id;
                    $reclamation->state = $state;
                    Cache::put($chat_id, $reclamation, now()->addDays(5));
                    AnswerManger::sendAnswer(['state' => States::ASK_STUDENT_CARD_NUMBER, 'chat_id' => $chat_id]);
                }
            }

        } catch (Exception $e) {
            info("Exception during caching " . $e);
        }*/
    }

    /* private function cache(Reclamation $reclamation, int $state, $chat_id)
    {
        $reclamation->state = $state;
        Cache::put($chat_id, $reclamation, now()->addDays(5));
        AnswerManger::sendAnswer(['state' => $state, 'chat_id' => $chat_id]);
    }*/

    private static function saveInDatabase($reclamation)
    {
        Reclamation::create(
            [
                'chat_id' => $reclamation->chat_id,
                'first_name' => $reclamation->first_name,
                'last_name' => $reclamation->last_name,
                'specialty' => $reclamation->specialty,
                'semester' => $reclamation->semester,
                'student_card_number' => $reclamation->student_card_number,
                'teaching_unit_code' => $reclamation->teaching_unit_name,
                'teaching_unit_name' => $reclamation->teaching_unit_name,
                'file_path' => $reclamation->file_path,
            ]
        );
    }
}
