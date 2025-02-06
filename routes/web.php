<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Metacompress;

Route::get('/', Metacompress::class);

require __DIR__ . '/auth.php';
