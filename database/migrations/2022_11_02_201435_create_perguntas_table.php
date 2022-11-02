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
        Schema::create('perguntas', function (Blueprint $table) {
            $table->id();
            // $table->string('codigo', 6);
            $table->string('revisao', 3);
            $table->string('ordem', 2);
            $table->string('descricao', 100);
            $table->integer('status');
            // $table->string('mensagem_tooltip');
            $table->enum('tipo_relacao', [
                'alinea',
                'paragrafo',
                'inciso'
            ]);
            $table->foreignId('relacao_id');
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
        Schema::dropIfExists('perguntas');
    }
};
