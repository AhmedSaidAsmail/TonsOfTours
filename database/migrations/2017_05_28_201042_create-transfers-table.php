<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('dist_from');
            $table->text('dist_to');
            $table->integer('type_limousine')->nullable();
            $table->integer('type_van')->nullable();
            $table->integer('type_coaster')->nullable();
            $table->integer('type_bus')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('transfers');
    }

}