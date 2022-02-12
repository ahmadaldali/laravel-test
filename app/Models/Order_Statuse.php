<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Statuse extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
    ];

    /**
     * Get the orders for the statuse.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_statuse_uuid', 'uuid');
    }
}