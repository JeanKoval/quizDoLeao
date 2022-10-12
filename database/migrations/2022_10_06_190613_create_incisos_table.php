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
        Schema::create('incisos', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->string('numeroRomano', 10);
            $table->integer('status');
            $table->integer('tipo_relacao');
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
        Schema::dropIfExists('incisos');
    }
};
