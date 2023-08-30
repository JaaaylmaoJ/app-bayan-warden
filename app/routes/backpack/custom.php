<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tg-message', 'TgMessageCrudController');
    Route::crud('tg-user', 'TgUserCrudController');
    Route::crud('jobs', 'JobsCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('tg-unhandled-update', 'TgUnhandledUpdateCrudController');
    Route::crud('tg-message-photo', 'TgMessagePhotoCrudController');
    Route::crud('tg-message-video', 'TgMessageVideoCrudController');
}); // this should be the absolute last line of this file