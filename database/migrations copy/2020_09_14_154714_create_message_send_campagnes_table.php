<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageSendCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_send_campagnes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->references('id')->on('messages_campagnes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('campagne_id');
            $table->foreign('campagne_id')->references('id')->on('campagnes')->onDelete('restrict')->onUpdate('restrict');
            $table->text('num_reception');
             $table->date('dateEnvoi');
            $table->time('heureEnvoi');
            $table->text('message');
            $table->integer('etat')->default(1);
            $table->integer('dlr')->default(0);
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
         Schema::table('message_send_campagnes', function(Blueprint $table) {
            $table->dropForeign('message_id');
            $table->dropForeign('campagne_id');

        });
        Schema::dropIfExists('message_send_campagnes');
    }
}
