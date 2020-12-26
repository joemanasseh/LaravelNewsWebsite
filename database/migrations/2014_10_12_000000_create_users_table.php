<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('role', ['superadmin','admin','member'])->default('member');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->bigInteger('phone_no')->nullable();
            $table->string('author')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othername')->nullable();
            $table->enum('gender', ['Male','Female','Rather not Say'])->nullable();
            $table->string('dob')->nullable();
            $table->string('country')->nullable();
            $table->text('about')->nullable();
            $table->string('occupation')->nullable();
            $table->string('industry')->nullable();
            $table->string('job_desc')->nullable();
            $table->string('education')->nullable();
            $table->string('photo')->default('head.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
