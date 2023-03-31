<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->integer('nroControl');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->date('fecha');
            $table->date('fechaVencimiento');
            $table->decimal('subtotal',50,2)->nullable();
            $table->decimal('exento',50,2)->nullable();
            $table->decimal('iva',50,2)->nullable();
            $table->decimal('total',50,2)->nullable();
            $table->integer('estado');
            $table->integer('tipo');
            $table->integer('cxc');
            $table->date('fechaCxc');
            $table->decimal('tasaCambio',50,3)->nullable();
            $table->decimal('descuento',50,3)->nullable();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('invoices');
    }
}
