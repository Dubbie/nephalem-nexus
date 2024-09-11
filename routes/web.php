<?php

use App\Http\Controllers\BuildController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/guide/', [BuildController::class, 'index'])->name('build.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/guide/own', [BuildController::class, 'myBuilds'])->name('build.own.index');
    Route::get('/guide/{build}/preview', [BuildController::class, 'preview'])->name('build.preview');
    Route::get('/guide/{build}/edit', [BuildController::class, 'edit'])->name('build.edit');
    Route::post('/guide/{build}/update', [BuildController::class, 'update'])->name('build.update');
    Route::get('/guide/{build}/edit/introduction', [BuildController::class, 'editIntroduction'])->name('build.edit.introduction');
    Route::post('/guide/{build}/edit/introduction/update', [BuildController::class, 'updateIntroduction'])->name('build.update.introduction');
    Route::get('/guide/{build}/edit/gear', [BuildController::class, 'editGear'])->name('build.edit.gear');
    Route::get('/guide/{build}/edit/skill-tree', [BuildController::class, 'editSkillTree'])->name('build.edit.skill-tree');
    Route::post('/guide/{build}/edit/skill-tree/update', [BuildController::class, 'updateSkillTree'])->name('build.update.skill-tree');
    Route::get('/guide/{build}/edit/sections', [BuildController::class, 'editSections'])->name('build.edit.sections');
    Route::post('/guide/{build}/edit/sections/update', [BuildController::class, 'updateSections'])->name('build.update.sections');
    Route::post('/guide/{build}/update/status', [BuildController::class, 'updateStatus'])->name('build.update.status');
    Route::post('/guide/store', [BuildController::class, 'store'])->name('build.store');
});

Route::get('/guide/{build}', [BuildController::class, 'show'])->name('build.show');

require __DIR__ . '/auth.php';
