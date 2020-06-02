<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function(Blueprint $table){
            $table->bigIncrements('category_id');
            $table->integer('category_parent_id')->default(0);
            $table->string('category_name', 100);
            $table->string('category_icon', 25);
        });

        Schema::create('field', function(Blueprint $table){
            $table->bigIncrements('field_id');
            $table->foreignId('category_id');
            $table->string('field_name', 100);
            $table->string('field_label', 100);
            $table->string('field_type', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
