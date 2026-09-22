<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_product';
    protected $fillable = [
        'product_name',
        'id_category',
        'id_supplier'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }   
    public function supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
    public function stockMovements(){
        return $this->hasMany(StockMovement::class, 'id_product', 'id_product');
    } 
    //
}
     