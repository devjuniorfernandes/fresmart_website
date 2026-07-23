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
        Schema::table('recipes', function (Blueprint $table) {
            $table->integer('portions')->default(4)->after('prep_time_minutes');
            $table->boolean('is_featured')->default(false)->after('instructions');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('btn_link');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('phone');
            $table->text('services_json')->nullable()->after('status');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('youtube');
            $table->string('support_phone')->nullable()->after('contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['portions', 'is_featured']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'services_json']);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'support_phone']);
        });
    }
};
