<?php

namespace App\Http\Controllers\Api\V1\Bot\BayanWarden;

use BotMan\BotMan\BotMan;
use App\Http\Controllers\Controller;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class BotmanWebhookController extends Controller
{
    private Botman $botman;
    public function __construct()
    {
        $this->botman = resolve('botman');
    }

    public function index()
    {
        $botman = $this->botman;

        $botman->hears('/help', function (BotMan $bot) {
            $bot->reply(<<<HTML
<b>/help</b> - список команд
<b>/help</b> - список команд
<b>/help</b> - список команд
HTML);
        });

        $botman->hears('/ping', function (BotMan $bot) {
            $bot->reply('da da ya');
        });

        $botman->hears('/sri', function (BotMan $bot) {
            $user     = $bot->getUser();
            $messages = $bot->getMessages();
            /** @var IncomingMessage $message */
            $message = $messages[0];
            $signature = $message->getPayload()->get('author_signature');
        });

        $botman->hears('привет', function (BotMan $bot) {
            $bot->reply('sam привет');
        });

        /*$botman->hears('[\s\S]*', function (BotMan $bot) {
            $bot->reply('ответ на всё');
        });*/

        $botman->group(['recipient' => '1234567890'], function($bot) {
            $bot->hears('keyword', function($bot) {
                // Only listens when recipient '1234567890' is receiving the message.
            });
        });

        // $botman->say('Мои первые слова', [-1001940077524]);

        $botman->listen();

        $a = 1;
    }
}