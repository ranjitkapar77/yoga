<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('post');
            $table->string('image');
            $table->string('address')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('website')->nullable()->default(null);
            $table->string('content')->nullable()->default(null);
            $table->string('facebook')->nullable()->default(null);
            $table->string('linkedin')->nullable()->default(null);
            $table->string('youtube')->nullable()->default(null);
            $table->string('twitter')->nullable()->default(null);
            $table->boolean('status');
            $table->integer('in_order');
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
        Schema::dropIfExists('teams');
    }
}
