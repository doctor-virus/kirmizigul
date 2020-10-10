<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxiProduct extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'tp_product');
    }
    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'tp_taxi');
    }
}
