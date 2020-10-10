<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function taxis()
    {
        return $this->hasMany(TaxiProduct::class, 'tp_product');
    }
}
