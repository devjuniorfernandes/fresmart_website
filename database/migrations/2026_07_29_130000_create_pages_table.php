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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('content_title')->nullable();
            $table->longText('content')->nullable();
            $table->string('section_image_1')->nullable();
            $table->string('section_image_2')->nullable();
            $table->string('section_image_3')->nullable();
            $table->longText('extra_content_1')->nullable();
            $table->longText('extra_content_2')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
