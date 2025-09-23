<?php

use App\Livewire\AlternativeConfiguration;
use App\Livewire\Question;
use Illuminate\Support\Facades\Route;

Route::get('configurations', AlternativeConfiguration::class)->name('configurations.index');

Route::get('question', Question::class);

Route::get('/', function () {
    return view('welcome');
});
