<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campagnes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->integer('etat')->default(1); 
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
    {   Schema::table('campagnes', function(Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('campagnes');
    }
}
