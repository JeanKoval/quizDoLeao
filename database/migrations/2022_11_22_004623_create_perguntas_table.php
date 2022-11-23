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
            $table->string('revisao', 3);
            $table->string('ordem', 2);
            $table->text('descricao');
            $table->integer('status');
            $table->string('campo_manipulacao_lead');
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
