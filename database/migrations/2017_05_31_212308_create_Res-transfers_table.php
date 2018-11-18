<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResTransfersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('res_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id');
            $table->text('title');
            $table->float('price');
            $table->text('date');
            $table->text('dist_from');
            $table->text('dist_to');
            $table->text('transfer_type');
            $table->integer('transfer_times');
            $table->integer('pax');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('res_transfers');
    }

}