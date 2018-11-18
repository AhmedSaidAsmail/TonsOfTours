<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivtePrices extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('private_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->text("sort");
            $table->text('pax_1')->nullable();
            $table->text('pax_2')->nullable();
            $table->text('pax_3')->nullable();
            $table->text('pax_4')->nullable();
            $table->text('pax_10')->nullable();
            $table->text('pax_18')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('private_prices');
    }

}