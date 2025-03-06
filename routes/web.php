<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Metacompress;

Route::get('/', Metacompress::class)->name('home');
