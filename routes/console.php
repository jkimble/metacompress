<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;

Schedule::command('cleanup:storage');
