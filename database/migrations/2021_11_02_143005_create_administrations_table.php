<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->decimal("tasaInventario",50,2);
            $table->decimal("tasaVenta",50,2);
            $table->decimal("ivaAdministracion",10,3);
            $table->string("claveautorizacion");
            $table->date("vencimiento");
            $table->integer('tickera')->nullable();
            $table->integer('importado')->nullable();
            $table->string('empresa')->nullable();
            $table->string('rif')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
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
        Schema::dropIfExists('administrations');
    }
}
