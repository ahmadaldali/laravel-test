<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //primary key
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'title', 'slug', 'content', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];
}