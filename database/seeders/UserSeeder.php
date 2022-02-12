<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => '9967f302-8bf6-11ec-91c4-4e8ee0b7f29a',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@buckhill.co.uk',
            'password' => Hash::make('admin'),
            'address' => 'N/A',
            'phone_number' => '0440440440',
        ]);
    }
}