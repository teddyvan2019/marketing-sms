<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepertoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repertoires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->string('description')->nullable($value = true);
            $table->integer('etat')->default(0);
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
        Schema::table('repertoires', function(Blueprint $table) {
			$table->dropForeign('user_id');
		});
        Schema::dropIfExists('repertoires');
    }
}
