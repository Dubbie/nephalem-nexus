<?php

use App\Http\Controllers\Api\BuildApiController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'build',
], function () {
    Route::get('/', [BuildApiController::class, 'fetch'])->name('api.build.fetch');
});
