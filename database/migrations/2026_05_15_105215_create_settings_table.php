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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('company_desc');
            $table->text('address');
            $table->string('whatsapp', 30);
            $table->string('email', 150);
            $table->text('maps_embed');
            $table->string('facebook');
            $table->string('instagram');
            $table->text('visson');
            $table->text('mission');
            $table->string('logo');
            $table->string('favicon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
