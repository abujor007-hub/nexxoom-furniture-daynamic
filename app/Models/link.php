<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    protected $fillable = [
        'facebook',
        'youtube',
        'twitter',
        'webSite',
        'github',
        'whatsApp',
        'linkedin',
        'gmail'
    ];
}
