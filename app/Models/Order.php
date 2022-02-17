<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'products', 'address'
    ];

    protected $casts = [
        'products' => 'array',
        'address' => 'array',
    ];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    /**
     * Get the payment
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_uuid', 'uuid');
    }

    /**
     * Get the order_statuse
     */
    public function order_statuse()
    {
        return $this->belongsTo(Order_Statuse::class, 'order_statuse_uuid', 'uuid');
    }


    /**
     * @todo: add a new order record to the DB
     */
    public static function saveOrder($data)
    {
        DB::beginTransaction();
        try {
            $order = new Order();
            foreach ($data as $field => $value) {
                $order->$field = $value;
            }
            $order->save();
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            Log::info('error in save/Order Model: ' . $e->getMessage());
            DB::rollBack();
            return null;
        } //catch
    } //save


}//class
