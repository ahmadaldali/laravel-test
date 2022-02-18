<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Traits\OrderProductData;
use Tests\TestCase;
use Illuminate\Support\Str;

class OrderProductDataTest extends TestCase
{
    use OrderProductData;

    /**
     *
     * @return void
     */
    public function test_calculate_the_amount()
    {
        $products = [];
        for ($i = 1; $i < 4; $i++) {
            $product = new Product();
            $product->uuid = Str::uuid()->toString();
            $product->category_uuid = Category::factory()->create()->uuid;
            $product->title = 'Title Test' . $i;
            $product->price = 100 * $i;
            $product->description = 'Random description num: ' . $i;
            $product->metadata = [];
            $product->save();
            $products[] = [
                "product" => $product->uuid,
                "quantity" => 5 * $i,
            ];
        }

        //calculate the amount
        $order = $this->getDetails($products);
        $amount = $order['total_amount'];
        //5*100 + 10*200 + 15*300 = 7000
        $this->assertEquals(7000, $amount);
    } //unittest

    public function test_calculate_the_amount_with_deliver_fee()
    {
        $products = [];
        for ($i = 1; $i < 3; $i++) {
            $product = new Product();
            $product->uuid = Str::uuid()->toString();
            $product->category_uuid = Category::factory()->create()->uuid;
            $product->title = 'Title Test' . $i;
            $product->price = 5 * $i;
            $product->description = 'Random description num: ' . $i;
            $product->metadata = [];
            $product->save();
            $products[] = [
                "product" => $product->uuid,
                "quantity" => 3 * $i,
            ];
        }

        //calculate the amount
        $order = $this->getDetails($products);
        $amount = $order['total_amount'];
        //5*3 + 10*6  = 75 --> delivery fee is = 11.25 -->
        //ceil(11.25) = 11 --> total: 87.00
        $this->assertEquals(87, $amount);
    } //unit2 with delivery
}