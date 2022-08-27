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
        Schema::create('base_juridicas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('revisao', 3);
            $table->integer('status');
            $table->integer('tipo');
            $table->string('ano', 4);
            $table->text('descricao')->nullable();
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
        Schema::dropIfExists('base_juridica');
    }
};
