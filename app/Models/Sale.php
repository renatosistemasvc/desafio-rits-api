<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'date',
        'status',
        'price_sale',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function itensSale()
    {
        return $this->hasMany('App\Models\ItemSale');
    }

    

}
