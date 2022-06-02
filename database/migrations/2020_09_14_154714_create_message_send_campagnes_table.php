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
        Schema::create('message_sent_campagnes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->references('id')->on('messages_campagnes')->onDelete('restrict')->onUpdate('restrict');
            $table->string('from');
            $table->string('destinataire');
            $table->dateTime('dateHeure');
            $table->text('message');
            $table->text('dlr');
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

        });
        Schema::dropIfExists('message_send_campagnes');
    }
}
