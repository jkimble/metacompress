<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanupStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all image storage.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = storage_path('app/private/livewire-tmp');
        if (File::exists($directory) && !File::isEmptyDirectory($directory)) {
            File::cleanDirectory($directory);
            $this->info('Images cleared.');
        }
    }
}
