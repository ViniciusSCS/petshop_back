<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_created');
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('vacina_id')->nullable();
            $table->unsignedBigInteger('cirurgia_id')->nullable();
            $table->string('data_castracao')->nullable();
            $table->string('descricao_cirurgica')->nullable();
            $table->enum('banho_tosa',['Banho', 'Tosa', 'Banho e Tosa'])->nullable();
            $table->enum('castrado',['Sim', 'Não'])->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('procedimentos');
    }
}
