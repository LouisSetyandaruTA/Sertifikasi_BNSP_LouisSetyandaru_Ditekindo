<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameProduct extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'stok',
        'harga',
        'image',
    ];
}
