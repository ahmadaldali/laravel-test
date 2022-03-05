<?php

namespace App\Traits;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

trait OrderProductData
{
    /**
     * @param $items
     * @return array
     * @todo: calculate the details based on the products
     * @todo: total amount, sub total, delivery fee, and the products details
     */
    public static function getDetails($items)
    {
        try {
            $sub_total = 0;
            $products_details = [];
            $i = 1;
            //pass each item
            foreach ($items as $item) {
                //I need this cast, cuz when call the function in generate an invoice, the items are array
                $item = (object) $item;
                //get the product uuid
                $product_uuid = (string) $item->product;
                //get the price of that product
                $product = Product::find($product_uuid);
                //get the cost of that product within this order and add the cost to the result
                $current_amount = $product->price * $item->quantity;
                $sub_total += $current_amount;
                //format the necessary data
                $temp_record = [];
                $temp_record['index'] = $i;
                $temp_record['description'] = $product->description;
                $temp_record['Qty'] = $item->quantity;
                $temp_record['price'] = $product->price;
                $temp_record['amount'] = $current_amount;
                //add to the result
                $products_details[] = $temp_record;
                //increase the counter
                $i = $i + 1;
            } //item
            //get the other value
            $delivery_fee = self::getDeliveryFee($sub_total);
            $total_amount = $delivery_fee + $sub_total;
            //return the total cost (amount of products)
            return [
                'sub_total' => $sub_total,
                'delivery_fee' => $delivery_fee,
                'total_amount' => $total_amount,
                'products_details' => $products_details
            ];
        } catch (Exception $e) {
            Log::info('error in details/orderProductData trait: ' . $e->getMessage());
            //if something happened, return [] to return 422 response to the client
            return [];
        } //catch
    } //calculate amount

    /**
     * @param $amount
     * @return int
     * @todo: calculate if there is a delivery_fee or not
     */
    private static function getDeliveryFee($amount):int
    {
        //0 not null, cuz I set the default value is a double (0.0) not as null
        return ($amount < 500) ? ceil(15 * $amount / 100) : 0;
    } //get fee

}//trait
