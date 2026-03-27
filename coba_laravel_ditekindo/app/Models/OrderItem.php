<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'game_product_id', 'quantity', 'price'];

    public function gameProduct() {
        return $this->belongsTo(GameProduct::class);
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
