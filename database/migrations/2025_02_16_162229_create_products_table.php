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
            $table->string('slug')->unique();
            $table->decimal('price',20,1)->nullable();
            $table->decimal('special_price',20,1)->nullable();
            $table->string('special_price_type')->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price',20,5)->unsigned()->nullable();
            $table->string('sku')->nullable();
            $table->boolean('manage_stock')->nullable();
            $table->integer('dty')->nullable();
            $table->boolean('in_stock')->default(0);
            $table->integer('viewed')->unsigned()->default(0);
            $table->boolean('is_active');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
