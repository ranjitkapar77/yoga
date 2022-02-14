<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChooseUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choose_us', function (Blueprint $table) {
            $table->id();
            $table->string('choose_icon_1')->nullable();
            $table->text('choose_title_1')->nullable();
            $table->string('choose_icon_2')->nullable();
            $table->text('choose_title_2')->nullable();
            $table->text('choose_title_3')->nullable();
            $table->text('choose_title_4')->nullable();
            $table->string('image_title_4')->nullable();
            $table->string('image')->nullable();
            $table->string('vedio_link')->nullable();
            $table->text('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->text('btn_title')->nullable();
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
        Schema::dropIfExists('choose_us');
    }
}
