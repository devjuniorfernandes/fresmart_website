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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('section_image_4')->nullable()->after('section_image_3');
            $table->string('section_image_5')->nullable()->after('section_image_4');
            $table->string('section_image_6')->nullable()->after('section_image_5');
            $table->string('section_image_7')->nullable()->after('section_image_6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['section_image_4', 'section_image_5', 'section_image_6', 'section_image_7']);
        });
    }
};
