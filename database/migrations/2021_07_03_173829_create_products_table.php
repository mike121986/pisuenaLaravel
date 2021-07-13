<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Use App\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id');
            $table->integer('quantity')->nullable();
            $table->enum('status',[Product::BORRADOR,Product::PUBLICADO])->default(Product::BORRADOR);
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
