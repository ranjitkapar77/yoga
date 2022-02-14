<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('cover_image');
            $table->string('banner_image')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('descriptive_title');
            $table->longText('content');
            $table->date('written_on');
            $table->string('author');
            $table->increments('view_count');
            $table->boolean('news_blogs');

            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_keywords')->nullable()->default(null);
            $table->longText('meta_description')->nullable()->default(null);
            $table->string('og_image')->nullable()->default(null);
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
        Schema::dropIfExists('news');
    }
}
