<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_status', function (Blueprint $table) {
            $table->dropForeign(['reservation_code']);
        });
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropUnique('reservation_reservation_code_unique');
            $table->index('reservation_code');
        });
        Schema::table('reservation_status', function (Blueprint $table) {
            $table->foreign('reservation_code')->references('reservation_code')->on('reservation')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
