<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_uuid', 'uuid');
    }
}