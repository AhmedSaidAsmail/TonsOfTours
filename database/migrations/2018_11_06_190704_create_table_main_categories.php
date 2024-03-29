<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMainCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('arrangement')->default(0);
            $table->string('title');
            $table->text('img')->nullable();
            $table->text('txt')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('home')->default(0);
            $table->text('icon')->nullable();
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
        Schema::dropIfExists('main_categories');
    }
}
