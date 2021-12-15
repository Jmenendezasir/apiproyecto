<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nombre', 40);
            $table->string('email')->unique();
            $table->string('ciudad');
            $table->enum('rol',['invitado','usuario','gestor','administrador']);
            $table->string('password');
            $table->string('image', 100);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
