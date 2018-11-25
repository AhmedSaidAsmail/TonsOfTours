<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwoCheckOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_check_outs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_id');
            $table->string('public_key');
            $table->string('private_key');
            $table->boolean('ssl');
            $table->string('sandbox');
            $table->string('currency')->default('USD');
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
        Schema::dropIfExists('two_check_outs');
    }
}
