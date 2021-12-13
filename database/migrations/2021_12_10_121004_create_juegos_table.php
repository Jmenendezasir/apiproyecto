<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuegosTable extends Migration
{
    public function up()
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->integer('idJuego')->primary();
            $table->string('tituloJuego', 30)->default('');
            $table->string('descripcion');
            $table->integer('idGenero')->default(0);
            $table->double('precio', 5, 2)->default(0);
            $table->string('portada', 100)->default('');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('juegos');
    }
}
