<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $directory = storage_path('app/private/livewire-tmp');
    if (File::exists($directory) && !File::isEmptyDirectory($directory)) {
        File::cleanDirectory($directory);
    }
});
