<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = ['id', 'order_id', 'product_variant_id', 'quantity', 'price'];
}
