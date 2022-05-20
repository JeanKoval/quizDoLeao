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
            $table->string('codigo', 6);
            $table->string('nome', 100);
            $table->string('input_id', 50);
            $table->string('label', 50);
            $table->string('class');
            $table->string('input_type', '50');
            $table->string('mensagem_tooltip');
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
