<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshDB:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the DB daily and call the seeders';

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
     * @return void
     */
    public function handle()
    {
        print('Start Migration' . "\n");
        Artisan::call('migrate:fresh');
        print('End Migration' . "\n");
        print('Start Seeding' . "\n");
        Artisan::call('db:seed');
        print('End Seeding' . "\n");
        print('Start removing the files' . "\n");
        Artisan::call('remove:files');
        print('End removing' . "\n");
        Artisan::call('passport:install');
    }
}
