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
        Schema::table('settings', function (Blueprint $table) {
            // Products index banner
            $table->string('banner_products_image')->nullable();
            $table->string('banner_products_title')->nullable();
            $table->string('banner_products_subtitle')->nullable();

            // Services index banner
            $table->string('banner_services_image')->nullable();
            $table->string('banner_services_title')->nullable();
            $table->string('banner_services_subtitle')->nullable();

            // Campaigns index banner
            $table->string('banner_campaigns_image')->nullable();
            $table->string('banner_campaigns_title')->nullable();
            $table->string('banner_campaigns_subtitle')->nullable();

            // Stores index banner
            $table->string('banner_stores_image')->nullable();
            $table->string('banner_stores_title')->nullable();
            $table->string('banner_stores_subtitle')->nullable();

            // Contacts index banner
            $table->string('banner_contacts_image')->nullable();
            $table->string('banner_contacts_title')->nullable();
            $table->string('banner_contacts_subtitle')->nullable();

            // Recipes index banner
            $table->string('banner_recipes_image')->nullable();
            $table->string('banner_recipes_title')->nullable();
            $table->string('banner_recipes_subtitle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'banner_products_image', 'banner_products_title', 'banner_products_subtitle',
                'banner_services_image', 'banner_services_title', 'banner_services_subtitle',
                'banner_campaigns_image', 'banner_campaigns_title', 'banner_campaigns_subtitle',
                'banner_stores_image', 'banner_stores_title', 'banner_stores_subtitle',
                'banner_contacts_image', 'banner_contacts_title', 'banner_contacts_subtitle',
                'banner_recipes_image', 'banner_recipes_title', 'banner_recipes_subtitle'
            ]);
        });
    }
};
