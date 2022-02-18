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
        //open
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fos1',
            'type' => 'open'
        ]);
        //pending payment
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fos2',
            'type' => 'pending payment'
        ]);
        //paid
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fos3',
            'type' => 'paid'
        ]);
        //shipped
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fos4',
            'type' => 'shipped'
        ]);
        //cancelled
        Order_Statuse::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7fos5',
            'type' => 'cancelled'
        ]);
    }
}