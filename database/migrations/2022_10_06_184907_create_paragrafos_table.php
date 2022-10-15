<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paragrafos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->text('descricao')->nullable();
            $table->integer('status');
            $table->unsignedBigInteger('artigo_id');
            $table->foreign('artigo_id')->references('id')->on('artigos');
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
        Schema::dropIfExists('paragrafos');
    }
};
