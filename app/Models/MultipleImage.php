<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleImage extends Model
{
        protected $fillable = [
        'product_id',
        'more_image',
    ];

        public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
