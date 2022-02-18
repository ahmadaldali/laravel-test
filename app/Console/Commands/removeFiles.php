<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class removeFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all uploaded images because we migrate the DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all files in a directory
        $files =   Storage::allFiles('public/pet-shop');
        // Delete Files
        Storage::delete($files);
    }
}