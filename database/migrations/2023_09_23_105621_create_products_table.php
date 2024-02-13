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
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('product_name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->string('product_color')->nullable();
            $table->string('desc',500);
            $table->longText('details')->nullable();

            $table->float('original_price');
            $table->float('salling_price');
            $table->string('discount')->nullable();
            $table->integer('quantity');
            $table->string('date')->nullable();
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
