<?php

namespace Database\Factories;

use App\Models\Order_Statuse;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Traits\OrderProductData;
use App\Traits\SaveJson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    use SaveJson;
    use OrderProductData;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random_status_id = rand(1, 5);
        //if paid or shipped
        $payment_uuid = null;
        if ($random_status_id == 3 || $random_status_id == 4) {
            $payment_uuid = Payment::factory()->create()->uuid;
        }
        //generate products for this order
        $products = [];
        for ($i = 0; $i < rand(2, 5); $i++) {
            $products[] = [
                "product" => Product::factory()->create()->uuid,
                "quantity" => $this->faker->randomNumber(2),
            ];
        }
        //calculate the amount
        $order = $this->getDetails($products);
        $amount = $order['sub_total'];
        return [
            'uuid' => Str::uuid()->toString(),
            'user_uuid' => User::factory()->create()->uuid,
            'payment_uuid' => $payment_uuid,
            'order_statuse_uuid' => Order_Statuse::all()->skip($random_status_id - 1)->take(1)->first()->uuid,
            'products' => $products,
            'address' => [
                "billing" => Str::random(15),
                "shipping" => Str::random(15),
            ],
            'amount' => $amount,
        ];
    }
}
