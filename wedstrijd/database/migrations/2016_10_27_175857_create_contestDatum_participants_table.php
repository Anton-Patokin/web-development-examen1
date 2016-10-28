<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestDatumParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contestDatums_participant', function (Blueprint $table) {

            $table->integer('Contestdatums_id')->unsigned();
            $table->foreign('Contestdatums_id')
                ->references('id')->on('Contestdatums')
                ->onDelete('cascade');
            $table->integer('participants_id')->unsigned();
            $table->foreign('participants_id')
                ->references('id')->on('participants')
                ->onDelete('cascade');
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
        Schema::dropIfExists('contestDatum_participant');
    }
}
