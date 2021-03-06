<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemRelated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->bigIncrements('item_id');
            $table->foreignId('category_id')->default(0);
            $table->foreignId('subcategory_id')->default(0);
            $table->foreignId('collection_id')->default(0);
            $table->string('item_name', 255);
            $table->text('item_descript');
            $table->string('item_img', 100);
            $table->string('item_creator', 100)->nullable();
            $table->string('item_release', 4)->nullable();
            $table->string('item_editor', 100)->nullable();
            $table->text('item_tracklist')->nullable();
            $table->integer('item_idx_collection')->nullable();
            $table->string('item_universe', 100)->nullable();
            $table->string('item_type', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('item_user', function(Blueprint $table){
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('user_id');
            $table->boolean('item_borrowable')->default(1);
        });

        Schema::create('collection', function(Blueprint $table) {
            $table->bigIncrements('collection_id');
            $table->string('collection_name', 255);
            $table->text('collection_descript');
            $table->integer('collection_length');
            $table->string('collection_creator', 100)->nullable();
            $table->string('collection_editor', 100)->nullable();
            $table->string('collection_release', 100)->nullable();
            $table->string('collection_universe', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('wish', function(Blueprint $table){
            $table->bigIncrements('wish_id');
            $table->foreignId('user_id');
            $table->foreignId('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
        Schema::dropIfExists('item_user');
        Schema::dropIfExists('collection');
        Schema::dropIfExists('wish');
    }
}
