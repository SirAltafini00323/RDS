<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdresseLivraisonTelLivraisonToPaniers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->string('telLivraison')->nullable();
            $table->string('adresseLivraison')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->dropColumn('telLivraison');
            $table->dropColumn('adresseLivraison');
        });
    }
}
