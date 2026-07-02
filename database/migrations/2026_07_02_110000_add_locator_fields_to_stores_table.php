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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('city')->nullable()->after('slug');
            $table->string('bairro')->nullable()->after('city');
            $table->time('opening_time')->nullable()->after('lng');
            $table->time('closing_time')->nullable()->after('opening_time');
            $table->string('phone')->nullable()->after('closing_time');
            $table->string('email')->nullable()->after('phone');
            $table->string('image')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'bairro',
                'opening_time',
                'closing_time',
                'phone',
                'email',
                'image'
            ]);
        });
    }
};
