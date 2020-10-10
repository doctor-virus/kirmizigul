<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class, 't_city');
    }
    public function products()
    {
        return $this->hasMany(TaxiProduct::class, 'tp_taxi');
    }
}
