<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->text('body');
            $table->string('image');
            $table->string('image_credit')->nullable();
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')
                ->references('id')->on('topics')
                ->onDelete('cascade');
            $table->unsignedBigInteger('subtopic_id');
            $table->foreign('subtopic_id')
                ->references('id')->on('subtopics')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->enum('editor_status', ['pending','published','rejected'])
                ->default('pending');
            $table->unsignedInteger('view_count')->default(1);
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
        Schema::dropIfExists('articles');
    }
}
