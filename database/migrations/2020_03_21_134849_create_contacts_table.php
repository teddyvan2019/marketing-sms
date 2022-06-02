<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom',255);
            $table->string('prenom',255);
            $table->date('date_naissance');
            $table->string('telephone',15); 
            $table->string('email',100); 
            $table->date('date_relance'); 
            $table->string('profession'); 
            $table->integer('etat')->default(1); 
 
            $table->unsignedBigInteger('repertoire_id');
            $table->foreign('repertoire_id')->references('id')->on('repertoires')->onDelete('restrict')->onUpdate('restrict');
           
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('restrict')->onUpdate('restrict');
          
            $table->unsignedBigInteger('religion_id');  
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('restrict')->onUpdate('restrict');
           
            $table->unsignedBigInteger('sexe_id');
            $table->foreign('sexe_id')->references('id')->on('genres')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::table('contacts', function(Blueprint $table) {
			$table->dropForeign('repertoire_id');
			$table->dropForeign('ville_id');
			$table->dropForeign('religion_id');
			$table->dropForeign('sexe_id');
		});
        Schema::dropIfExists('contacts');
    }
}
