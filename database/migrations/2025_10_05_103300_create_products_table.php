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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('small_description')->nullable();

            // Prices
            $table->decimal('price', 10, 2); 
            $table->decimal('discount_price', 10, 2)->nullable(); 

            // Stock
            $table->unsignedInteger('stock')->default(0);
            $table->string('sku')->nullable();

            // Product Type
            $table->boolean('flash_sales')->default(false);
            $table->boolean('best_sell')->default(false);

            // Relations
            $table->uuid('category_id')->nullable();
            $table->uuid('brand_id')->nullable();

            // Image
            $table->string('image')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            // Index
            $table->index(['category_id', 'brand_id']);
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
