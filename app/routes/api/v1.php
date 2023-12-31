<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Bot\BayanWarden\SdkWebhookController;
use App\Http\Controllers\Api\V1\Bot\BayanWarden\BotmanWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$botToken = config('telegram.bots.@BayanWardenBot.token');
// $telegram = new Api($botToken);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sort', [Controller::class, 'sort']);

Route::group([
    'middleware' => [
        'log.webhook',
        'tg_user.create',
    ]
], function() use ($botToken) {
    Route::post("/bot/bayan-warden/$botToken/sdk/webhook", [SdkWebhookController::class, 'index']);
    Route::post("/bot/bayan-warden/$botToken/botman/webhook", [BotmanWebhookController::class, 'index']);
});
