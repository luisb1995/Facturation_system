<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deposit_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string("codigo");
            $table->string("descripcion");
            $table->decimal("cantidad",50,3)->nullable();
            $table->decimal("costo",50,2)->nullable();
            $table->decimal("ganancia",50,2)->nullable();
            $table->decimal("precio",50,2)->nullable();
            $table->decimal("divisa",50,4)->nullable();
            $table->integer("iva")->nullable();
            $table->integer("actualizar")->nullable();
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->foreign('deposit_id')->references('id')->on('deposits')
            ->onDelete('set null')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
