<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'type' => $this->faker->randomElement(['credit_card', 'cash_on_delivery', 'bank_transfer']),
            'details' => [
                "holder_name" => $this->faker->name(25),
                "number" => $this->faker->phoneNumber(),
                "ccv" => $this->faker->randomNumber(8),
                "expire_date" => $this->faker->dateTimeBetween('now', '+8 years'),
            ],
        ];
    }
}
