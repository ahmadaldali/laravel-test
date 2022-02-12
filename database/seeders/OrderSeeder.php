<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29o',
            'user_uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29a',
            'payment_uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f2pa',
            'order_statuse_uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f2os',
            'products' => [
                "product" => "9967f302-8bf6-11ec-91c4-4e8ee0b7f29p",
                "quantity" => 14,
            ],
            'address' => [
                "billing" => "Address1",
                "shipping" => "Address2"
            ],
            'amount' => 500,
        ]);
    }
}