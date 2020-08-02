<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    protected $table = 'itens_sales';

    protected $fillable = [
        'quanty',
        'price_subtotal',
        'product_id',
        'sale_id'
    ];

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }


}
