<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table){
            $table->bigIncrements('id_stock_movement');
            $table->unsignedBigInteger('id_product');
            $table->enum('movement_type', ['in', 'out']);
            $table->integer('stock_amount');

            $table->foreign('id_product')->references('id_product')->on('products');
             $table->timestamps();
        });

        
    
    //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
        //
    }
};
