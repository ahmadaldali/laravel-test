<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'description', 'metadata',
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }
}