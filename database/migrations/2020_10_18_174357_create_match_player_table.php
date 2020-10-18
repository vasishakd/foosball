<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_player', function (Blueprint $table) {
            $table->foreignId('match_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('player_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('type');

            $table->primary(['match_id', 'player_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_player');
    }
}
