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
        Schema::table('campaigns', function (Blueprint $table) {
            if (!Schema::hasColumn('campaigns', 'show_title')) {
                $table->boolean('show_title')->default(true)->after('is_active');
            }
            if (!Schema::hasColumn('campaigns', 'show_button')) {
                $table->boolean('show_button')->default(true)->after('show_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['show_title', 'show_button']);
        });
    }
};
