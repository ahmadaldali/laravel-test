<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29b',
            'title' => 'Brand1',
            'slug' => 'Slug Brand1',
        ]);
    }
}