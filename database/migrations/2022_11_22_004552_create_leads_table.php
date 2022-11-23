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
            $table->string('email', 100)->nullable();
            $table->string('telefone', 11)->nullable();
            $table->boolean('renda_tributavel')->nullable();
            $table->boolean('renda_nao_tributavel')->nullable();
            $table->boolean('ganho_de_capital')->nullable();
            $table->boolean('opera_bolsa_de_valores')->nullable();
            $table->boolean('receita_bruta_atividade_rural')->nullable();
            $table->boolean('compensar_prejuizo_atividade_rural')->nullable();
            $table->boolean('bens_e_direitos')->nullable();
            $table->boolean('residente_no_brasil')->nullable();
            $table->boolean('isencao_imoveis')->nullable();
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
