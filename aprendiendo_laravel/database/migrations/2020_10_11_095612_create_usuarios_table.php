<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Esta es una forma de crear la tabla
        /*
        // Con Schema::create creamos la tabla. Con Schema::table modificaríamos la tabla
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');  // Con el método increments le decimos que ese campo/columna es auto-incremental
            $table->string('nombre', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->integer('edad');
            $table->timestamps();  // Esta función crea automáticamente los campos created_at y updated_at
        });
        */
        
        // Esta es otra forma
        DB::statement("		
            CREATE TABLE usuarios(
            id   int(255) auto_increment not null,
            nombre varchar(255),
            email  varchar(255),
            password varchar(255),
            PRIMARY KEY(id)
            );");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            Schema::drop('usuarios');  // De esta manera se borra la tabla
        });
    }
}
