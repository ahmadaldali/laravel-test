<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29c',
            'title' => 'Category1',
            'slug' => 'Slug Cat1',
        ]);
    }
}