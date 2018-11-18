<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivatePrices extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('privates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->text("sort");
            $table->integer('1pax');
            $table->integer('2pax');
            $table->integer('3pax');
            $table->integer('4pax');
            $table->integer('10pax');
            $table->integer('18pax');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('privates');
    }

}