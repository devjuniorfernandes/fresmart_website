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
        Schema::table('services', function (Blueprint $table) {
            $table->string('additional_image')->nullable()->after('gallery');
            $table->string('btn_text')->nullable()->after('additional_image');
            $table->string('btn_link')->nullable()->after('btn_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['additional_image', 'btn_text', 'btn_link']);
        });
    }
};
