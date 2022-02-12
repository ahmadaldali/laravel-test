<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(OrderStatuseSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(PromotionSeeder::class);
    }
}