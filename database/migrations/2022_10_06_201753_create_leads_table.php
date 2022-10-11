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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->float('renda_tributavel');
            $table->float('renda__nao_tributavel',10);
            $table->string('email', 100);
            $table->string('telefone', 11);
            $table->string('ano_nascimento', 4);
            $table->string('profissao', 50);
            $table->string('cidade', 30);
            $table->string('estado', 2);
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
        Schema::dropIfExists('leads');
    }
};
