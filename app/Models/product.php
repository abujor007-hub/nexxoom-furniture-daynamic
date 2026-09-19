<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'price',
        'discount_price',
        'quantity',
        'status',
        'image'
    ];


    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
