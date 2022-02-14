<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('company_name');
            $table->string('email');
            $table->string('contact_no');
            $table->integer('province_no');
            $table->integer('district_no');
            $table->longText('local_address');
            $table->string('company_logo');
            $table->string('footer_logo');
            $table->string('company_favicon');
            $table->string('pan_vat');

            $table->string('projects_completed');
            $table->string('total_employees');
            $table->string('happy_clients');

            $table->longText('aboutus')->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();

            $table->longText('map_url')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('og_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
