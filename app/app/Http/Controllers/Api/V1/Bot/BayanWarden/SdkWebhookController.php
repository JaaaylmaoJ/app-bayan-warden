<?php

namespace App\Http\Controllers\Api\V1\Bot\BayanWarden;

use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class SdkWebhookController extends Controller
{
    public function index(): string
    {
        $update = Telegram::getWebhookUpdate();

        return 'ok';
    }
}