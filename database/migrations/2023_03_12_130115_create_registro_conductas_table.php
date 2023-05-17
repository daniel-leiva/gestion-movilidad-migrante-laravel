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
        Schema::create('registro_conductas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('migrante')->nullable(false);
            $table->foreign('migrante')->references('id')->on('migrantes');
            $table->longText('observaciones')->nullable(false);
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
        Schema::dropIfExists('registro_conductas');
    }
};
