<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $primaryKey = 'id_stock_movement';
    protected $fillable = [
        'id_product',
        'movement_type',
        'stock_amount',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
//
}
