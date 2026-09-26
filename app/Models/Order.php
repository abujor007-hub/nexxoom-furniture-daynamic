<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'message',
        'subtotal',
        'shipping',
        'total',
        'paymentMethod',
        'status',
        'country',
        'city',
        'distirct',
        'post_code',
        'transaction_id'
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
