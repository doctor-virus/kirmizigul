<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 's_product');
    }
    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 's_taxi');
    }
}
