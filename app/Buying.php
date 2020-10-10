<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buying extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'b_product');
    }
}
