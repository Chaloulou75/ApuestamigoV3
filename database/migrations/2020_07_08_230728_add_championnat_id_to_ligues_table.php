<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChampionnatIdToLiguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligues', function (Blueprint $table) {
            $table->unsignedBigInteger('championnat_id')->default('1')->onDelete('cascade')->after('id');
            $table->foreign('championnat_id')->references('id')->on('championnats')->onUpdate('cascade')->onDelete('cascade')->onDelete('cascade');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('championnat_id')->default('1')->after('id');
            $table->foreign('championnat_id')->references('id')->on('championnats')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('date_journees', function (Blueprint $table) {
            $table->unsignedBigInteger('championnat_id')->default('1')->after('id');
            $table->foreign('championnat_id')->references('id')->on('championnats')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('championnat_id')->default('1')->after('id');
            $table->foreign('championnat_id')->references('id')->on('championnats')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('equipes', function (Blueprint $table) {
            $table->unsignedBigInteger('championnat_id')->default('1')->after('id');
            $table->foreign('championnat_id')->references('id')->on('championnats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligues', function (Blueprint $table) {
            $table->dropColumn('championnat_id');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('championnat_id');
        });

        Schema::table('date_journees', function (Blueprint $table) {
            $table->dropColumn('championnat_id');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('championnat_id');
        });

        Schema::table('equipes', function (Blueprint $table) {
            $table->dropColumn('championnat_id');
        });
    }
}
