<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsInstantanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_instantanes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('from');
            $table->string('destinataire');
            $table->text('message');
            $table->dateTime('dateHeure');
            $table->integer('etat')->default(1);
            $table->string('dlr')->default('');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::table('sms_instantanes', function(Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('sms_instantanes');
    }
}
