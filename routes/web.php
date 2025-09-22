<?php

use App\Livewire\AlternativeConfiguration;
use App\Livewire\Question;
use Illuminate\Support\Facades\Route;
use App\Livewire\ConfigurationForm;

Route::get('configurations', AlternativeConfiguration::class)->name('configurations.index');

Route::get('configurations/create', ConfigurationForm::class)->name('configurations.create');

Route::get('configurations/edit/{configuration}', ConfigurationForm::class)->name('configurations.edit');

Route::get('question', Question::class);

Route::get('/', function () {
    return view('welcome');
});
