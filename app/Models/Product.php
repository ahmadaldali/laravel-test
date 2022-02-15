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



    public static function get()
    {
        return Product::find('9967f302-8bf6-11ec-91c4-4e8ee0b7f29p');
    }
}