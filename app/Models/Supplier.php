<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'name_supplier'
    ];
    //

    public function products() {
        return $this->hasMany(Product::class, 'id_supplier', 'id_supplier');
    }
}
