<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToLiguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligues', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id')->nullable()->after('name');
            $table->foreign('creator_id')->references('id')->on('users');
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
            $table->dropColumn('creator_id');
        });
    }
}
