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
        Schema::create('option_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('option_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->unique(['locale','option_id']);
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_translations');
    }
};
