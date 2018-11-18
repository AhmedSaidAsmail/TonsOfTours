<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id');
            $table->text('title');
            $table->float('price');
            $table->text('date');
            $table->integer('st_no');
            $table->float('st_price');
            $table->string('st_name');
            $table->integer('sec_no');
            $table->float('sec_price');
            $table->string('sec_name');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tours');
    }

}