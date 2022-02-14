<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_title');
            $table->string('content_page_title')->nullable();
            $table->string('content_url');
            $table->string('content_body')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('freezone_img')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_title')->nullable();
            $table->enum('content_type', ['About', 'Page', 'Article', 'FAQ', 'Welcome', 'Team','Courses'])->default('Page');
            $table->enum('show_on_menu', ['Y', 'N', 'T', 'P'])->default('N');
            $table->string('external_link')->nullable();;
            $table->enum('publish_status', ['0', '1'])->default('1');
            $table->enum('delete_status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('contents');
    }
}
