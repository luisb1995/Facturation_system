<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('divisa',50,2)->nullable();
            $table->decimal('zelle',50,2)->nullable();
            $table->string('refZelle')->nullable();
            $table->decimal('bolivares',50,2)->nullable();
            $table->decimal('debito',50,2)->nullable();
            $table->string('refDebito')->nullable();
            $table->decimal('credito',50,2)->nullable();
            $table->string('refCredito')->nullable();
            $table->decimal('transferencia',50,2)->nullable();
            $table->string('refTransferencia')->nullable();

            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')
            ->onDelete('cascade')
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
        Schema::dropIfExists('abonos');
    }
}
