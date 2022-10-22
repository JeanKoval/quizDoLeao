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
        Schema::create('alineas', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->string('letra', 1);
            $table->integer('status');
            $table->enum('tipo_relacao', ['artigo', 'paragrafo', 'inciso']);
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
        Schema::dropIfExists('alineas');
    }
};
