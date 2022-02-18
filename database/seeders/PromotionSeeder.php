<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fpro',
            'title' => 'Promotion1',
            'content' => 'Promotion random content',
            'metadata' =>  [
                "valid_from" => "20-12-2020",
                'valid_to' => "20-12-2023",
                "image" => ""
            ],
        ]);
    }
}