<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Borrows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function(Blueprint $table){
            $table->bigIncrements('borrow_id');
            $table->foreignId('item_id');
            $table->foreignId('lender_id');
            $table->foreignId('borrower_id');
            $table->string('borrow_state', 2);
            $table->dateTime('borrow_date_begin');
            $table->dateTime('borrow_date_end');
            $table->text('borrow_deny')->nullable();
            $table->integer('borrow_duration')->nullable();
            $table->date('borrow_date_renew_asked')->nullable();
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
        Schema::dropIfExists('borrow');
    }
}
