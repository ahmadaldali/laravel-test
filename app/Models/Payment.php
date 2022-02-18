<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'type', 'details'
    ];

    protected $casts = [
        'details' => 'array',
    ];

    /**
     * Get the orders for the payment.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_uuid', 'uuid');
    }
}