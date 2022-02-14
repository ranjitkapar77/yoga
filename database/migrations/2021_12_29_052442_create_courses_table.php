<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image');
            $table->string('image');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('course_category')->nullable();
            $table->string('destination')->nullable();
            $table->string('course_level')->nullable();
            $table->string('month_intake')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('qualification')->nullable();
            $table->string('course_fee')->nullable();
            $table->string('requirements')->nullable();
            $table->string('description')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('youtube_link')->nullable();;
            $table->enum('publish_status', ['0', '1'])->default('1');
            $table->enum('delete_status', ['0', '1'])->default('0');
            $table->enum('show_in_menu', ['0', '1'])->default('0');
            $table->text('content');
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
        Schema::dropIfExists('courses');
    }
}
