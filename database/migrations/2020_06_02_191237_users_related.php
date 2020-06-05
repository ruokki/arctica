<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRelated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->foreignId('role_id');
            $table->string('user_name', 100);
            $table->string('user_firstname', 100);
            $table->string('user_lastname', 100);
            $table->string('user_email', 255);
            $table->string('user_pwd', 255);
            $table->boolean('user_active');
            $table->timestamps();
        });

        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('role_id');
            $table->string('role_name', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('role');
    }
}
