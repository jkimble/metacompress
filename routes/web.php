<?php

use App\Livewire\Faqs;
use Illuminate\Support\Facades\Route;
use App\Livewire\Metacompress;

Route::get('/', Metacompress::class)->name('home');
Route::get('/faqs', Faqs::class)->name('faqs');
