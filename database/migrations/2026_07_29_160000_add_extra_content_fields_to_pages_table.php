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
            $table->longText('extra_content_3')->nullable()->after('extra_content_2');
            $table->longText('extra_content_4')->nullable()->after('extra_content_3');
            $table->longText('extra_content_5')->nullable()->after('extra_content_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['extra_content_3', 'extra_content_4', 'extra_content_5']);
        });
    }
};
