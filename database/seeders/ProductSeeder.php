<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29p',
            'category_uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29c',
            'title' => 'Product1',
            'price' => 1300.54,
            'description' => 'Description',
            'metadata' =>  [
                "brand" => "9967f302-8bf6-11ec-91c4-4e8ee0b7f29b",
                "image" => "9967f302-8bf6-11ec-91c4-4e8ee0b7f29f"
            ],
        ]);
    }
}