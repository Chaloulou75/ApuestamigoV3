<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSlugToLiguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('date_journees', function (Blueprint $table) {
            $table->dropColumn('season');
        });

        Schema::table('date_journees', function (Blueprint $table) {
            $table->dropColumn('numerojournee');
        });

        Schema::table('equipes', function (Blueprint $table) {
            $table->dropColumn('groupe');
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
            //
        });
    }
}
