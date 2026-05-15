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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->enum('type', ['product', 'portfolio', 'service', 'banner', 'testimonial', 'company', 'gallery'])->default('gallery');
            $table->string('caption');
            $table->string('alt_text');
            $table->enum('status', [true, false]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
