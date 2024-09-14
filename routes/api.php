<?php

use App\Http\Controllers\Api\BuildApiController;
use App\Http\Controllers\Api\ItemApiController;
use App\Http\Controllers\Api\NotificationApiController;
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

// Only logged in users should call these
Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/notifications', [NotificationApiController::class, 'fetch'])->name('api.notification.fetch');
    Route::get('/notifications/unread', [NotificationApiController::class, 'fetchUnread'])->name('api.notification.fetch.unread');
    Route::post('/notifications/read/all', [NotificationApiController::class, 'readAll'])->name('api.notification.read.all');
    Route::post('/notifications/clear/all', [NotificationApiController::class, 'clearAll'])->name('api.notification.clear.all');
    Route::post('/notifications/read/{notification}', [NotificationApiController::class, 'read'])->name('api.notification.read');
});
