<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f2pa',
            'type' => 'credit_card',
            'details' =>  [
                "holder_name" => "name1",
                "number" => "2303-2324-23424",
                "ccv" => '42422342',
                "expire_date" => "22-02-2023",
            ],
        ]);
    }
}