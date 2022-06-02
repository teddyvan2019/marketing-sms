<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_campagnes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campagne_id');
            $table->foreign('campagne_id')->references('id')->on('campagnes')->onDelete('restrict')->onUpdate('restrict');
            $table->date('dateEnvoi');
            $table->time('heureEnvoi');
            $table->text('message');
            $table->integer('etat')->default(1);
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
       Schema::table('messages_campagnes', function(Blueprint $table) {
            $table->dropForeign('campagne_id');
        });
        Schema::dropIfExists('messages_campagnes');
    }
}
