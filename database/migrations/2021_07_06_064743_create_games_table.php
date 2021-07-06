<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('home_team')->nullable();
            $table->string('guest_team')->nullable();
            $table->date('date')->default(null)->nullable();
            $table->string('city')->nullable();
            $table->string('stadium')->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('score_home')->nullable();
            $table->integer('score_guest')->nullable();
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
        Schema::dropIfExists('games');
    }
}
