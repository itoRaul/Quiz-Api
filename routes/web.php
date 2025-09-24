<?php

use App\Livewire\AlternativesConfiguration;
use App\Livewire\Questions;
use Illuminate\Support\Facades\Route;

Route::get('configurations', AlternativesConfiguration::class)->name('configurations.index');

Route::get('question', Questions::class)->name('question');

Route::get('/', function () {
    return view('welcome');
});
