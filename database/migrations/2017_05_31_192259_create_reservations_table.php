<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('f_name');
            $table->text('sur_name');
            $table->text('email');
            $table->text('hotel');
            $table->text('mobile');
            $table->text('arrival_flight_no')->nullable();
            $table->text('arrival_flight_time')->nullable();
            $table->text('departure_flight_no')->nullable();
            $table->text('departure_flight_time')->nullable();
            $table->text('date');
            $table->integer('tours');
            $table->integer('transfers');
            $table->float('total');
            $table->float('deposit');
            $table->boolean('paid')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reservations');
    }

}