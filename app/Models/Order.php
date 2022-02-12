<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}