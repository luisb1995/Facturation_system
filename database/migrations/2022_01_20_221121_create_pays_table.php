<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->decimal('divisa',50,2)->nullable();
            $table->decimal('zelle',50,2)->nullable();
            $table->string('refZelle')->nullable();
            $table->decimal('Bolivares',50,2)->nullable();
            $table->decimal('Debito',50,2)->nullable();
            $table->string('refDebito')->nullable();
            $table->decimal('Credito',50,2)->nullable();
            $table->string('refCredito')->nullable();
            $table->decimal('Transferencia',50,2)->nullable();
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
        Schema::dropIfExists('pays');
    }
}
