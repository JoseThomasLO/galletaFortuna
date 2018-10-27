<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookiesTable extends Migration
{
    /**
     * Run the migrations.
     * Código que se va a ejecutar cuando ponga esa migración. Crea la tabla cookies.
     * @return void
     */
    public function up()
    {
        Schema::create('cookies', function (Blueprint $table) {
            $table->increments('id'); //Crea el atributo id que por defecto da Laravel.
            $table->string('message', 240); //Crea el atributo message para la frase de la galleta de la fortuna, con su límite de caracteres.
            $table->timestamps(); //Crea los atributos created_at y updated_at que da por defecto Laravel.

        });
    }

    /**
     * Reverse the migrations.
     * Borrar la tabla, se ejecuta al usar el down.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cookies');
    }
}
