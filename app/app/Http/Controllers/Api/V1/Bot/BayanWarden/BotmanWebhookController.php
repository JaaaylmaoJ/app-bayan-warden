<?php

namespace App\Http\Controllers\Api\V1\Bot\BayanWarden;

use App\Models\TgUser;
use BotMan\BotMan\BotMan;
use App\Http\Controllers\Controller;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class BotmanWebhookController extends Controller
{
    private Botman $botman;

    private const IMG_GOSLYAROV = '/img/goslyarov.png';

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
<b>/say что-нибудь</b> - список команд
<b>/ping</b> - пингануть бота
<b>/users</b> - список сохраненных пользователей
HTML);
        });

        $botman->hears('/say [\s\S]*', function (BotMan $bot) {
            $bot->reply(OutgoingMessage::create(attachment: new Image(
                sprintf(
                    '%s%s',
                    config('app.url'),
                    self::IMG_GOSLYAROV
                )
            )));
        });

        $botman->hears('/ping', function (BotMan $bot) {
            $bot->reply('da da ya');
        });

        $botman->hears('/users', function (BotMan $bot) {
            $list = TgUser::all()->map(fn(TgUser $u) => sprintf("<b>@%s</b> - %s %s", $u->username, $u->first_name, $u->last_name));

            $bot->reply(implode("\n", $list->all()));
        });

        $botman->hears('/zxc', function (BotMan $bot) {
            $user     = $bot->getUser();
            $messages = $bot->getMessages();
            /** @var IncomingMessage $message */
            $message = $messages[0];
            $signature = $message->getPayload()->get('author_signature');
        });

        $botman->hears('.* прив .*', function (BotMan $bot) {
            $bot->reply('Bonjour');
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