<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/questoes', [QuestionController::class, 'allQuestions']); //->middleware('auth.basic');

Route::post('/auth/criarquestao', [QuestionController::class, 'createQuestion']);

Route::put('/auth/editarquestao/{id}', [QuestionController::class, 'editQuestion']);

Route::delete('/auth/deletarquestao/{id}', [QuestionController::class, 'deleteQuestion']);

Route::post('/auth/criarconfiguracao', [ConfigurationController::class, 'createConfiguration']);

Route::put('/auth/editarconfiguracao/{id}', [ConfigurationController::class, 'editConfiguration']);

Route::delete('/auth/deletarconfiguracao/{id}', [ConfigurationController::class, 'deleteConfiguration']);
