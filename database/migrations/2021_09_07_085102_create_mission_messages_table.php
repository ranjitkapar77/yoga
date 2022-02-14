<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_messages', function (Blueprint $table) {
            $table->id();
            $table->longText('mission')->nullable();
            $table->longText('vision')->nullable();
            $table->longText('company_values')->nullable();
            $table->string('welcome_title')->nullable();
            $table->string('welcome_sub_title')->nullable();
            $table->longText('welcome_message')->nullable();
            $table->string('youtube_link')->nullable();
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
        Schema::dropIfExists('mission_messages');
    }
}
