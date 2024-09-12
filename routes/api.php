<?php

use App\Http\Controllers\Api\BuildApiController;
use App\Http\Controllers\Api\ItemApiController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'build',
], function () {
    Route::get('/', [BuildApiController::class, 'fetch'])->name('api.build.fetch');
});

Route::group([
    'prefix' => 'item',
], function () {
    Route::get('/', [ItemApiController::class, 'fetch'])->name('api.item.fetch');
});
