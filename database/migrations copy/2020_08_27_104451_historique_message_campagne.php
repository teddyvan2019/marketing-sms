<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoriqueMessageCampagne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('historique_message_campagne', function (Blueprint $table) {
           $table->bigIncrements('id');

            $table->integer('message_id')->unsigned();
             $table->foreign('message_id')
                  ->references('id')
                  ->on('messages')
                  ->onDelete('cascade');
            $table->integer('repertoire_id')->unsigned();
            $table->foreign('repertoire_id')
                  ->references('id')
                  ->on('repertoires')->onDelete('cascade');
   
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('historique_message_campagne', function(Blueprint $table) {
            $table->dropForeign('repertoire_id');
            $table->dropForeign('message_id');

        });
        Schema::dropIfExists('historique_message_campagne');
    }
}
