<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGooglelocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('googlelocations', function (Blueprint $table) {
            $table->increments('id');
            $table->double('lat', 15, 8);
            $table->double('lng', 15, 8);
            $table->double('distance', 15, 4);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('contest_id')->unsigned()->index();
            $table->foreign('contest_id')
                ->references('id')->on('contests')
                ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('googlelocations');
    }
}
