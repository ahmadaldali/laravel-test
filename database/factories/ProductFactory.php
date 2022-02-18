<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'category_uuid' =>  Category::factory()->create()->uuid,
            'title' => $this->faker->text(25),
            'price' => $this->faker->randomNumber(5),
            'description' => $this->faker->text(),
            'metadata' =>  [
                "brand" => function () {
                    return Brand::factory()->create()->uuid;
                },
                "image" => ""
            ],
        ];
    }
}