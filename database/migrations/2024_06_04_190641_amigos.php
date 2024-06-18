<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_amigo');
            $table->string('estado_amistad');
            $table->timestamp('fecha_solicitud')->nullable();
            $table->timestamp('fecha_aceptacion')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_amigo')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['id_usuario', 'id_amigo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('amigos');
    }
};
