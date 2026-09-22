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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->string('product_name');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_supplier');

            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
