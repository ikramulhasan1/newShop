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
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->double('price', 10, 2);
            $table->double('compare_price', 10, 2)->nullable();
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->text('track_qty', ['Yes', 'No'])->default('Yes')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('status')->default(1);
            $table->string('category');
            $table->unsignedBigInteger('category_id')->default(1);
            $table->string('sub_category')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('brand');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->enum('is_featured', ['Yes', 'No'])->default('No');
            $table->string('image')->nullable();
            $table->softDeletes();
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
