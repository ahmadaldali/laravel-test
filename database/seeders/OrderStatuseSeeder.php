<?php

namespace Database\Seeders;

use App\Models\Order_Statuse;
use Illuminate\Database\Seeder;

class OrderStatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f2os',
        ]);
    }
}