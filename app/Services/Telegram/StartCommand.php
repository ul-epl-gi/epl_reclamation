<?php

namespace App\Services\Telegram;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;


class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';
    

    public function handle()
    {
        # username from Update object to be used as fallback.
        $fallbackUsername = $this->getUpdate()->getMessage()->from->username;

        # Get the username argument if the user provides,
        # (optional) fallback to username from Update object as the default.
        $username = $this->argument(
            'username',
            $fallbackUsername
        );

        $this->replyWithMessage([
            'text' => "Salut {$username}! Je suis epl_reclamation je vais vous aidez dans votre demande de reclamation:"
        ]);

        $this->replyWithMessage([
            'text' => "Voulez-vous faire une reclamation?"
        ]);

    }
}
