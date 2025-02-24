<?php

use App\Livewire\Faqs;
use Illuminate\Support\Facades\Route;
use App\Livewire\Metacompress;

Route::get('/', Metacompress::class);
Route::get('/faqs', Faqs::class);
