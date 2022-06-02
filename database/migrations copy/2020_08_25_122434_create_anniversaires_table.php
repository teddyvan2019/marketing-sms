<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnniversairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anniversaires', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description');
            $table->date('dateDebut');
            $table->date('dateFin');
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
        Schema::dropIfExists('anniversaires');
    }
}
