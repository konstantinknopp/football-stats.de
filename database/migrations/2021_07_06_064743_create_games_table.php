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
            $table->unsignedBigInteger('home_team_id')->nullable();
            $table->foreign('home_team_id')->references('id')->on('teams')->nullOnDelete();
            $table->unsignedBigInteger('guest_team_id')->nullable();
            $table->foreign('guest_team_id')->references('id')->on('teams')->nullOnDelete();
            $table->date('date')->default(null)->nullable();
            $table->unsignedBigInteger('stadium_id')->nullable();
            $table->foreign('stadium_id')->references('id')->on('stadia')->nullOnDelete();
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
