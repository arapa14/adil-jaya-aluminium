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
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('focus_keyword');
            $table->string('og_title');
            $table->text('og_description');
            $table->string('og_image');
            $table->string('canonical_url');
            $table->enum('robots_index', ['index', 'noindex'])->default('index');
            $table->enum('robots_follow', ['follow', 'nofollow'])->default('follow');
            $table->longText('schema_markup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
