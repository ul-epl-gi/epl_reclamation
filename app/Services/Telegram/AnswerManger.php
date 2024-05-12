<?php

namespace App\Services\Telegram;

use App\Utils\States;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use Telegram\Bot\Laravel\Facades\Telegram;

class AnswerManger
{
    public static function sendAnswer(array $data)
    {
        $message = "";
        $state = $data['state'];
        $chat_id = $data['chat_id'];

        #This will update the chat status to "typing..."
        Telegram::sendChatAction(['chat_id' => $chat_id, 'action' => Actions::TYPING]);
        switch ($state) {
            case States::ASK_STUDENT_CARD_NUMBER:
                $message = "Quelle est votre numéro de carte ?";
                break;
            case States::ASK_FULL_NAME:
                $message = "Quelle est votre nom complet (nom et prénoms)?";
                break;
            case States::ASK_SPECIALTY:
                $message = "Quelle est votre spécialité? ex: GE, GL, GC";
                break;
            case States::ASK_SEMESTER:
                $message = "Quelle est votre semestre? ex: 1,4,5";
                break;
            case States::ASK_TEACHING_UNIT_CODE:
                $message = "Quelle le code de la matière que vous voulez réclamer?";
                break;
            case States::ASK_TEACHING_UNIT_NAME:
                $message = "Quelle l'intitulé de la matière que vous voulez réclamer?";
                break;
            case States::ASK_FILE:
                $message = "Veuillez m'envoyer votre fiche d'UE";
                break;
            case States::ASK_CONFIRMATION:
                $message = "Confirmez vous votre demande reclamation ? (oui ou non)";
                break;
            case States::SEND_CONFIRMATION_MESSAGE:
                $message = "Merci!! Votre demande de reclamation sera pris en compte par le service des examens de l'EPL";
                break;
            case States::SEND_CANCELLATION_MESSAGE:
                $message = "Votre demande de reclamation à été annulé";
                break;
            default:
                $message = "";
                break;
        }

        #send the message
        Telegram::sendMessage(['chat_id' => $chat_id, 'text' => $message]);
    }


}
