<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'pname',
        'quantity',
        'price',
        'category'

    ];
    public function stockOuts(){
        return $this->hasMany(StockOut::class);
    }

    public function stockIns(){
        return $this->hasMany(StockIn::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
