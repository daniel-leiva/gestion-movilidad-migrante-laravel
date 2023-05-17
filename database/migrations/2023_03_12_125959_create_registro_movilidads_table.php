<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registro_movilidads', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);
            $table->unsignedBigInteger('migrante')->nullable(false);
            $table->foreign('migrante')->references('id')->on('migrantes');
            $table->string('tipologia')->nullable(false);
            $table->string('plan_movilidad')->nullable(false);
            $table->date('fecha_ingreso')->nullable(false);
            $table->date('fecha_salida')->nullable(false);
            $table->integer('locker')->nullable(true);
            $table->string('bodega')->nullable(true);
            $table->longText('observaciones')->nullable(false);
            $table->unsignedBigInteger('caravana')->nullable(true);
            $table->foreign('caravana')->references('id')->on('caravanas');
            $table->unsignedBigInteger('nucleo')->nullable(true);
            $table->foreign('nucleo')->references('id')->on('nucleos');
            $table->unsignedBigInteger('usuario')->nullable(false);
            $table->foreign('usuario')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_movilidads');
    }
};
