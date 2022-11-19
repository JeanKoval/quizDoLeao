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
            $table->uuid('cookie_lead')->unique();
            $table->boolean('necessita_declarar')->nullable();
            $table->string('nome', 50)->nullable();
            $table->float('renda_tributavel')->nullable();
            $table->float('renda_nao_tributavel',10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telefone', 11)->nullable();
            $table->string('ano_nascimento', 4)->nullable();
            $table->string('profissao', 50)->nullable();
            $table->string('cidade', 30)->nullable();
            $table->string('estado', 2)->nullable();
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
