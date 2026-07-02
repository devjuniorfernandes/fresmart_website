<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title')->nullable();
        });
        Schema::table('stores', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
