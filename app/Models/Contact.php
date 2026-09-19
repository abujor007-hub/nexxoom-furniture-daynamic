<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'fullName',
        'email',
        'phone',
        'address',
        'message'
    ];
}
