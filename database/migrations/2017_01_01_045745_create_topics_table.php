<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('txt')->nullable();
            $table->text('icon')->nullable();
            $table->boolean('top')->default(0);
            $table->boolean('footer')->default(0);
            $table->boolean('sidebar')->default(0);
            $table->string('top_link')->nullable();
            $table->string('footer_link')->nullable();
            $table->string('sidebar_link')->nullable();
            $table->integer('arrangement')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('topics');
    }

}