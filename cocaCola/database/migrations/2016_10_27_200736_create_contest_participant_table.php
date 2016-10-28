<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_participant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned()->index();
            $table->foreign('contest_id')
                ->references('id')->on('contests')
                ->onDelete('cascade');
            $table->integer('participant_id')->unsigned()->index();
            $table->foreign('participant_id')
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
        Schema::dropIfExists('contest_participant');
    }
}
