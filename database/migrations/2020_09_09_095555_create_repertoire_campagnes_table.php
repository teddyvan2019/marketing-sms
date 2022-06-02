<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepertoireCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repertoire_campagnes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('messages_id');
            $table->foreign('messages_id')
                ->references('id')
                ->on('messages_campagnes')
                ->onDelete('cascade');

            $table->unsignedBigInteger('repertoire_id');
            $table->foreign('repertoire_id')
                ->references('id')
                ->on('repertoires')
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
        Schema::table('repertoire_campagnes', function(Blueprint $table) {
            $table->dropForeign('campagne_id');
            $table->dropForeign('repertoire_id');

        });
        Schema::dropIfExists('repertoire_campagnes');
    }
}
