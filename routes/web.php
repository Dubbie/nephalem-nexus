<?php

use App\Http\Controllers\BuildApproveController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/guide', [BuildController::class, 'index'])->name('build.index');
Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::get('/guide/{build}', [BuildController::class, 'show'])->name('build.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/guide/own', [BuildController::class, 'myBuilds'])->name('build.own.index');
    Route::get('/guide/{build}/preview', [BuildController::class, 'preview'])->name('build.preview');
    Route::post('/guide/{build}/like', [BuildController::class, 'like'])->name('build.like');
    Route::delete('/guide/{build}/delete', [BuildController::class, 'delete'])->name('build.destroy');
    Route::get('/guide/{build}/edit', [BuildController::class, 'edit'])->name('build.edit');
    Route::post('/guide/{build}/update', [BuildController::class, 'update'])->name('build.update');
    Route::get('/guide/{build}/edit/introduction', [BuildController::class, 'editIntroduction'])->name('build.edit.introduction');
    Route::post('/guide/{build}/edit/introduction/update', [BuildController::class, 'updateIntroduction'])->name('build.update.introduction');
    Route::get('/guide/{build}/edit/gear', [BuildController::class, 'editGear'])->name('build.edit.gear');
    Route::get('/guide/{build}/edit/skill-tree', [BuildController::class, 'editSkillTree'])->name('build.edit.skill-tree');
    Route::post('/guide/{build}/edit/skill-tree/update', [BuildController::class, 'updateSkillTree'])->name('build.update.skill-tree');
    Route::get('/guide/{build}/edit/sections', [BuildController::class, 'editSections'])->name('build.edit.sections');
    Route::post('/guide/{build}/edit/sections/update', [BuildController::class, 'updateSections'])->name('build.update.sections');
    Route::post('/guide/{build}/update/status/update', [BuildController::class, 'updateStatus'])->name('build.update.status');
    Route::post('/guide/store', [BuildController::class, 'store'])->name('build.store');

    Route::get('/waiting-for-approval', [BuildApproveController::class, 'index'])->name('build.wfa');
    Route::post('/guide/{build}/approve', [BuildApproveController::class, 'approve'])->name('build.approve');
    Route::post('/guide/{build}/decline', [BuildApproveController::class, 'decline'])->name('build.decline');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('settings.profile');
        Route::post('/profile/photo', [SettingsController::class, 'updateProfilePhoto'])->name('settings.profile.update.photo');
    });
});

require __DIR__ . '/auth.php';
