<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueMessageAnniversairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_message_anniversaires', function (Blueprint $table) {
            $table->id();
            $table->integer('anniversaire_id')->unsigned();
             $table->foreign('anniversaire_id')
                  ->references('id')
                  ->on('anniversaires')
                  ->onDelete('cascade');
            $table->integer('repertoire_id')->unsigned();
            $table->foreign('repertoire_id')
                  ->references('id')
                  ->on('repertoires')->onDelete('cascade');
   
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
         Schema::table('historique_message_anniversaires', function(Blueprint $table) {
            $table->dropForeign('repertoire_id');
            $table->dropForeign('anniversaire_id');

        });
        Schema::dropIfExists('historique_message_anniversaires');
    }
}
