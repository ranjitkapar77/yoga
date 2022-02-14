<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learns', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->text('page_title')->nullable();
            $table->text('description')->nullable();
            $table->text('language')->nullable();
            $table->text('fee')->nullable();
            $table->text('total_mark')->nullable();
            $table->text('required_mark')->nullable();
            $table->enum('publish_status', ['0', '1'])->default('1');
            $table->enum('delete_status', ['0', '1'])->default('0');
            $table->boolean('show_in_menu')->nullable();
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
        Schema::dropIfExists('learns');
    }
}
