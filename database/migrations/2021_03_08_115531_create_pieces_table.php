<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('description');
            $table->string('nom');
            $table->integer('stock')->nullable()->default(0);
            $table->double('prix');
            $table->unsignedBigInteger('categorie_id');


            $table->foreign('categorie_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pieces');
    }
}
