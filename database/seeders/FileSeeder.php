<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7file',
            'name' => 'testFile.jpg',
            'path' => 'storage/app/public/pet-shop/AAXGAaUDeF.jpg',
            'size' => '1985727',
            'type' => 'jpg',
        ]);
    }
}