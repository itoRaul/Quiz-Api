<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('quiz')->group(function () {
    Route::prefix('questoes')->group(function () {
        Route::get('/allquestions', [QuestionController::class, 'allQuestions']);
        Route::get('/', [QuestionController::class, 'onlyQuestions']);
        Route::post('/', [QuestionController::class, 'createQuestion']);
        Route::put('/{id}', [QuestionController::class, 'editQuestion']);
        Route::delete('/{id}', [QuestionController::class, 'deleteQuestion']);
    });

    Route::prefix('configuracoes')->group(function () {
        Route::get('/', [ConfigurationController::class, 'allConfigurations']);
        Route::post('/', [ConfigurationController::class, 'createConfiguration']);
        Route::put('/{id}', [ConfigurationController::class, 'editConfiguration']);
        Route::delete('/{id}', [ConfigurationController::class, 'deleteConfiguration']);
    });
});
