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
        Schema::create('migrantes', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);
            $table->integer('numero')->nullable(false);
            $table->string('nombre_apellido')->nullable(false);
            $table->bigInteger('npi')->nullable(false)->unique();
            $table->date('fecha_nacimiento')->nullable(false);
            $table->integer('edad')->nullable(false);
            $table->string('genero')->nullable(false);
            $table->string('nacionalidad')->nullable(false);
            $table->string('estado')->nullable(false);
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
        Schema::dropIfExists('migrantes');
    }
};
