<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrations', function (Blueprint $table) {
            $table->integer('tickera')->nullable()->after('vencimiento');
            $table->integer('importado')->nullable()->after('vencimiento');
            $table->string('empresa')->nullable()->after('vencimiento');
            $table->string('rif')->nullable()->after('vencimiento');
            $table->string('direccion')->nullable()->after('vencimiento');
            $table->string('telefono')->nullable()->after('vencimiento');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
