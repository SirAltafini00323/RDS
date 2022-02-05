<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjouterPieces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajouter_pieces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('piece_id');
            $table->unsignedBigInteger('panier_id');


            $table->foreign('piece_id')
                    ->references('id')
                    ->on('pieces')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->foreign('panier_id')
                    ->references('id')
                    ->on('paniers')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajouter_pieces');
    }
}
