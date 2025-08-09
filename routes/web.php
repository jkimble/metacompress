<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Metacompress;
use App\Livewire\Privacy;

Route::get('/', Metacompress::class)->name('home');
Route::get('/privacy', Privacy::class)->name('privacy');
