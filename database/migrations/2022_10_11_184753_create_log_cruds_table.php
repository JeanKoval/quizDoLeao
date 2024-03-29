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
        Schema::create('log_cruds', function (Blueprint $table) {
            $table->id();
            $table->enum('rotina',[
                    'pergunta',
                    'base-juridica',
                    'capitulo',
                    'artigo',
                    'inciso',
                    'paragrafo',
                    'alinea',
                    'lead'
                ]
            );
            $table->enum('acao', [
                    'incluir',
                    'visualizar',
                    'editar',
                    'inativar',
                    'excluir'
                ]
            );
            $table->bigInteger('registro_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('log_cruds');
    }
};
