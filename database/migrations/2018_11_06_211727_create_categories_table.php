<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_category_id')->unsigned();
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->string('name')->unique();
            $table->integer('arrangement')->default(0);
            $table->string('title');
            $table->string('img')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('recommended')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
