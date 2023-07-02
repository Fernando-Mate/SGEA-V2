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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('anos_xp')->nullable();
            $table->integer('ano_ingresso')->nullable();
            $table->date('dataNascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('nivelAcesso')->nullable();
            $table->string('funcao')->nullable();
            $table->string('telefone')->nullable();
            $table->tinyInteger('estado')->default(0);
            //$table->date('inicio_funcoes')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
