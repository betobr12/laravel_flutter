<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = "products";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'stock'
    ];
}
