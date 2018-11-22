<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('duration');
            $table->boolean('transfer')->default(0);
            $table->boolean('has_deposit')->default(0);
            $table->integer('deposit_percentage')->default(0);
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE items_details ADD CONSTRAINT CHK_PERCENTAGE CHECK (deposit_percentage <= 100);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_details');
    }
}
