<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('journee');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ligue_id');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ligue_id')->references('id')->on('ligues')->onDelete('cascade');

            $table->integer('resultatEq1')->nullable();
            $table->integer('resultatEq2')->nullable();

            $table->integer('pointMatch')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
