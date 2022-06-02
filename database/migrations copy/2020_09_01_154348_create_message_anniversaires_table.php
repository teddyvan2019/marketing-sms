<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageAnniversairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_anniversaires', function (Blueprint $table) {
            $table->id();
            $table->date('dateEnvoi');
            $table->text('message');
            $table->unsignedBigInteger('anniversaire_id');
            $table->foreign('anniversaire_id')->references('id')->on('anniversaires')->onDelete('restrict')->onUpdate('restrict');
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
         Schema::table('message_anniversaires', function(Blueprint $table) {
       $table->dropForeign('anniversaire_id');
        });
        Schema::dropIfExists('message_anniversaires');
    }
}
